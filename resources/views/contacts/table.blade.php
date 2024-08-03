@foreach ($contacts as $contact)
<tr class="border-t">
    <td class="border px-4 py-2">{{ $contact->name }}</td>
    <td class="border px-4 py-2">{{ $contact->email }}</td>
    <td class="border px-4 py-2">{{ $contact->created_at }}</td>
    <td class="border px-4 py-2">
        <a href="{{ route('contacts.show', $contact->id) }}" class="bg-green-400 text-white px-2 py-1 rounded">Show</a>
        <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
        <button data-id="{{ $contact->id }}" class="delete-btn bg-red-500 text-white px-2 py-1 rounded">Delete</button>
    </td>
</tr>
@endforeach