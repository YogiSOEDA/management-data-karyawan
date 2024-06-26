<option selected disabled value="">Select an option</option>
@foreach ($data as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach
