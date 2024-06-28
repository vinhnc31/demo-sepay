<!DOCTYPE html>
<html>
<head>
    <title>Order Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Order Form</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="orderForm" action="{{ route('form.handle') }}" method="POST">
        @csrf
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>

        <label for="transaction">Transaction:</label>
        <input type="text" id="transaction" name="transaction" required>

        <button type="submit" id="submitBtn">Submit</button>
    </form>

    <div id="qrCodeContainer">
        <!-- Placeholder for QR code image -->
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#orderForm').submit(function(event) {
                event.preventDefault(); // Prevent form from submitting normally

                var formData = $(this).serialize(); // Serialize form data

                // Send AJAX request to handle form submission
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Display QR code image
                        var qrImageUrl = response.qrUrl;
                        $('#qrCodeContainer').html(`<img src="${qrImageUrl}" alt="QR Code">`);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
