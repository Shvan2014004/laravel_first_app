<x-guest-layout>
    <form method="POST" action="{{ route('assets.store') }}">
        @csrf 
        <div class="form-group">
            <label for="Name">Description </label>
            <input type="text" class="form-control" id="description" placeholder="Description" name="description" required>
           </div>
           <div class="form-group">
            <label for="Name">Amount: </label>
            <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" required>
           </div>
           @csrf
           <div class="form-group">
            <label for="Name">Sub Category </label>
            {{-- <input type="text" class="form-control" id="sub_category_id" placeholder="Sub Category" name="sub_category_id" required> --}}
           
           <select name="sub_category_id" class="form-control">
            <option value="">Select a subcategory</option>
            @foreach($sub_category as $row)
                <option value="{{ $row->id }}">{{ $row->sub_category }}</option>
            @endforeach
            </select>
           </div>
           <button type="submit">Submit</button>
    </form>
</x-guest-layout>

