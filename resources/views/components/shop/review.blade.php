<div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
    <h2 class="product-single__reviews-title">Reviews</h2>
    <div class="product-single__reviews-list">
        @foreach ($reviews as $review )
            <div class="product-single__reviews-item">
                {{-- <div class="customer-avatar">
                <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                </div> --}}
                <div class="customer-review">
                <div class="customer-name">
                    <h6>{{$review->name}}</h6>
                    <div class="reviews-group d-flex">
                     @for ($i=0 ; $i<$review->rate; $i++)
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                     @endfor

                    </div>
                </div>
                <div class="review-date">{{$review->published_at}}</div>
                <div class="review-text">
                    <p>{{$review->comment}}</p>
                </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="product-single__review-form">
        @if (Session::has('status'))
            <div class="alert alert-success fade show disissible" role="alert">
            {{Session::get('status')}}
            </div>
        @endif
      <form  action="{{route('user.review.add')}}" method="POST">
        @csrf
        <input type="hidden"  name="product_id" value="{{$id}}" />
        <h5>Be the first to review “Message Cotton T-Shirt”</h5>
        <p>Your email address will not be published. Required fields are marked *</p>
        <div class="select-star-rating">
          <label>Your rating *</label>
          <span class="star-rating">
            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
            </svg>
            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
            </svg>
            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
            </svg>
            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
            </svg>
            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
            </svg>
          </span>
          <input type="hidden" name="rate" id="rating-value" value="0">
            <div class="mt-2">
                @error('rate')
                <span class="p-2 text-center alert-danger">
                {{$message}}
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-4">
          <textarea id="form-input-review" name="comment" class="form-control form-control_gray" placeholder="Your Review"
            cols="30" rows="8">{{old('comment')}}</textarea>
            <div  class="mt-2">
                @error('comment')
                <span class="p-2 my-20 text-center alert-danger">
                {{$message}}
                </span>
                @enderror
            </div>


        </div>

        <div class="mt-4 mb-4 form-label-fixed">
          <label for="form-input-name" class="form-label">Name *</label>
          <input id="form-input-name" value="{{old('name')}}" name="name" class="form-control form-control-md form-control_gray">
           <div  class="mt-2">
            @error('name')
            <span class="p-2 text-center alert-danger">
               {{$message}}
            </span>
           @enderror
           </div>
        </div>


        {{-- <div class="mt-4 mb-4 form-label-fixed">
          <label for="form-input-email" class="form-label">Email address *</label>
          <input id="form-input-email" name="email" class="form-control form-control-md form-control_gray">
        </div> --}}
        {{-- <div class="mt-4 mb-4 form-check">
          <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="remember_checkbox">
          <label class="form-check-label" for="remember_checkbox">
            Save my name, email, and website in this browser for the next time I comment.
          </label>
        </div> --}}
        <div class="form-action">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star-rating__star-icon");
    const ratingInput = document.getElementById("rating-value");

    stars.forEach((star, index) => {
        star.addEventListener("click", function () {
            let selectedRating = index + 1;
            ratingInput.value = selectedRating; // Store rating in input field

            // Reset all stars
            stars.forEach((s, i) => {
                s.style.fill = i < selectedRating ? "#f5c518" : "#ccc"; // Highlight selected stars
            });
        });

        star.addEventListener("mouseover", function () {
            // Highlight stars on hover
            stars.forEach((s, i) => {
                s.style.fill = i <= index ? "#f5c518" : "#ccc";
            });
        });

        star.addEventListener("mouseleave", function () {
            // Reset to the selected rating when mouse leaves
            let selectedRating = ratingInput.value || 0;
            stars.forEach((s, i) => {
                s.style.fill = i < selectedRating ? "#f5c518" : "#ccc";
            });
        });
    });
});

</script>
@endpush
