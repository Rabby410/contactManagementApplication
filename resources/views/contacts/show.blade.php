<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8 px-4 md:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Contact Details</h1>
        <a href="/contacts" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Back to List</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="border-b border-gray-200 pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Contact Information</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-lg font-medium text-gray-600 mb-2"><strong>Name:</strong></p>
                <p class="text-gray-800">{{ $contact->name }}</p>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-600 mb-2"><strong>Email:</strong></p>
                <p class="text-gray-800">{{ $contact->email }}</p>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-600 mb-2"><strong>Phone:</strong></p>
                <p class="text-gray-800">{{ $contact->phone }}</p>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-600 mb-2"><strong>Address:</strong></p>
                <p class="text-gray-800">{{ $contact->address }}</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
