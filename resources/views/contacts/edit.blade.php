<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8 px-4 md:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">Edit Contact</h1>
            <a href="/contacts" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Back to List</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <form id="editForm">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                    <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $contact->name }}">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $contact->email }}">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone:</label>
                    <input type="text" id="phone" name="phone" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $contact->phone }}">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-semibold mb-2">Address:</label>
                    <input type="text" id="address" name="address" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $contact->address }}">
                </div>

                <div>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update Contact</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#editForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/contacts/{{ $contact->id }}',
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        'Your contact has been updated.',
                        'success'
                    ).then(() => {
                        window.location.href = '/contacts';
                    });
                },
                error: function(response) {
                    Swal.fire(
                        'Error!',
                        'There was an error updating the contact.',
                        'error'
                    );
                }
            });
        });
    </script>

</body>

</html>
