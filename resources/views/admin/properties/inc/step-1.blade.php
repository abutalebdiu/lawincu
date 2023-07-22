 <input type="hidden" name="step" value="1">
 @if ($property)
     <input type="hidden" name="property_id" value="{{ $property->id }}">
 @endif

 <div class="row">
     <div class="col-md-6 mb-2">
         <label>Property Title</label>
         <input type="text" name="title" value="{{ $property->title ?? '' }}" class="form-control" required>
         <div class="invalid-feedback">
             This field is required.
         </div>
     </div>
     <div class="col-md-6 mb-2">
         <label>Property Title (Arabic)</label>
         <input type="text" name="title_ar" value="{{ $property->title_ar ?? '' }}" class="form-control" required>
         <div class="invalid-feedback">
             This field is required.
         </div>
     </div>
     <div class="col-sm-6">
         <div class="mb-1">
             <label>Choose Property Type (اختر نوع العقار)</label>
             <select class="form-control" name="property_type_id" id="property_type_id" required>
                 <option value="">-Select-</option>
                 @foreach ($propertytypes as $propertytype)
                     <option value="{{ $propertytype->id }}"
                             {{ optional($property)->property_type_id == $propertytype->id ? 'selected' : '' }}>
                         {{ $propertytype->name . ' (' . $propertytype->name_ar . ') ' }}
                     </option>
                 @endforeach
             </select>
             <div class="invalid-feedback">
                 This field is required.
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="mb-1">
             <label for="add_type">AD type (Purpose) (نوع الإعلان)</label>
             <select class="form-control" name="add_type" id="add_type" required>
                 <option value="">-Select-</option>
                 <option {{ optional($property)->add_type == 'sale' ? 'selected' : '' }} value="sale">For
                     Sale (للبيع)</option>
                 <option {{ optional($property)->add_type == 'rent' ? 'selected' : '' }} value="rent">For
                     Rent (للايجار)</option>
                 <option {{ optional($property)->add_type == 'auction' ? 'selected' : '' }} value="auction">
                     Auctions (المزادات)</option>
             </select>
             <div class="invalid-feedback">
                 This field is required.
             </div>
         </div>
     </div>
 </div>
