<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">Create Contact</h1>
            <a href="/contacts" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Back to List</a>
        </div>

            <form id="createForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium">Name:</label>
                    <input type="text" id="name" name="name" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Email:</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-medium">Phone:</label>
                    <input type="text" id="phone" name="phone" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-medium">Address:</label>
                    <input type="text" id="address" name="address" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#createForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/contacts',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire(
                        'Created!',
                        'Your contact has been created.',
                        'success'
                    ).then(() => {
                        window.location.href = '/contacts';
                    });
                },
                error: function(response) {
                    Swal.fire(
                        'Error!',
                        'There was an error creating the contact.',
                        'error'
                    );
                }
            });
        });
    </script>

</body>

</html>
