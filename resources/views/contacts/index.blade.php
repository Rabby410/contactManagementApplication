<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">Contacts</h1>
            <a href="{{ route('contacts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add Contact</a>
        </div>

        <div class="mb-4">
            <input type="text" id="search" placeholder="Search by name or email" class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white text-left">
                    <tr>
                        <th class="py-2 px-4"><a href="#" class="sort" data-sort="name">Name</a></th>
                        <th class="py-2 px-4"><a href="#" class="sort" data-sort="email">Email</a></th>
                        <th class="py-2 px-4"><a href="#" class="sort" data-sort="created_at">Created At</a></th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody id="contacts">
                    @include('contacts.table', ['contacts' => $contacts])
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let searchTimeout;

            function loadContacts(params) {
                $.get('{{ url('/contacts') }}', params, function(data) {
                    $('#contacts').html(data.html);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed:', textStatus, errorThrown);
                });
            }

            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/contacts/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your contact has been deleted.',
                                    'success'
                                ).then(() => {
                                    loadContacts({
                                        search: $('#search').val(),
                                        sort_by: $('.sort.asc, .sort.desc').data('sort'),
                                        sort_order: $('.sort.asc').length ? 'asc' : 'desc'
                                    });
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.sort', function(e) {
                e.preventDefault();
                var sort_by = $(this).data('sort');
                var sort_order = $(this).hasClass('asc') ? 'desc' : 'asc';
                $('.sort').removeClass('asc desc');
                $(this).addClass(sort_order);

                loadContacts({
                    sort_by: sort_by,
                    sort_order: sort_order,
                    search: $('#search').val()
                });
            });

            $('#search').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    loadContacts({
                        search: encodeURIComponent($('#search').val()),
                        sort_by: $('.sort.asc, .sort.desc').data('sort'),
                        sort_order: $('.sort.asc').length ? 'asc' : 'desc'
                    });
                }, 300);
            });

            // Initial load of contacts
            loadContacts({
                search: encodeURIComponent($('#search').val()),
                sort_by: $('.sort.asc, .sort.desc').data('sort'),
                sort_order: $('.sort.asc').length ? 'asc' : 'desc'
            });
        });
    </script>

</body>

</html>
