 <input type="hidden" name="step" value="2">
 @if ($property)
     <input type="hidden" name="property_id" value="{{ $property->id }}">
 @endif

 <div class="row">
     <div class="col-sm-6">
         <div class="mb-1">
             <label for="image">Property Images (<small class="text-warning">Max 1
                     MB</small></label>)

             <input id="image" type="file" name="images[]" class="form-control" multiple>
             <small> Every image size should be: 400x400 pixels</small>
             <div class="invalid-feedback">
                 The Image field is required.
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="mb-1">
             <label for="video">Attach a video<small class="text-warning">Max 10
                     MB</small></label>
             <input id="video" type="file" name="video" class="form-control" value="{{ old('video') }}">
             <small>Recommended video duration: 30sec - 5min</small>
         </div>
     </div>
 </div>
 @if ($property)
     <div class="row py-1 text-center">
         <div class="col-sm-6 border">
             @if ($property->image != '')
                 <img height="200px" src="{{ $property->urlOf('image') }}" alt="Not found">
             @else
                 <p class="p-5">
                     No imagers uploaded yet
                 </p>
             @endif
         </div>
         <div class="col-sm-6 border">
             @if ($property->video)
                 <video controls loo height="200px" src="{{ asset($property->video) }}"></video>
             @else
                 <p class="p-5">
                     No video uploaded yet
                 </p>
             @endif
         </div>
     </div>
 @endif
