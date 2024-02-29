<x-guest-layout>
    <form method="POST" action="{{ route('category.store') }}">
        @csrf 
        
           <div class="form-group">
            <label for="Name">Category: </label>
            <input type="text" class="form-control" id="category" placeholder="Category" name="category" required>
           </div>
         
           {{-- <div class="form-group">
            <label for="Name">Description </label>
            <input type="text" class="form-control" id="category" placeholder="Sub Category" name="category" required>
             <select name="item_id">
                <option value="">Select an item</option>
                @foreach($category as $id => $assets)
                    <option value="{{ $id }}">{{ $assets }}</option>
                @endforeach
            </select> 
           </div> --}}

           <button type="submit">Submit</button>
    </form>
</x-guest-layout>

