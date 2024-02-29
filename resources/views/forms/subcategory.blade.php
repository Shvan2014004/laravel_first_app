+<x-guest-layout>
    <form method="POST" action="{{ route('subcategory.store') }}">
        @csrf 
           <div class="form-group">
            <label for="Name">Sub Category: </label>
            <input type="text" class="form-control" id="sub_category" placeholder="Sub Category" name="sub_category" required>
           </div>
           <div class="form-group">
            <label for="Name">Category: </label>
            {{-- <input type="text" class="form-control" id="category_id" placeholder="Category" name="category_id" required> --}}
            <select name="category_id" class="form-control">
                <option value="">Select a subcategory</option>
                @foreach($category as $row)
                    <option value="{{ $row->id }}">{{ $row->category }}</option>
                @endforeach
                </select>
           </div>
           <button type="submit">Submit</button>
    </form>
</x-guest-layout>

