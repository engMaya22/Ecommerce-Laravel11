<footer class="footer footer_type_2">
    <div class="container footer-middle">
      <div class="row row-cols-lg-5 row-cols-2">
        <div class="mb-4 footer-column footer-store-info col-12 mb-lg-0">
          <div class="logo">
            <a href="{{route('home.index')}}">
              <img src="{{asset('assets/images/logo.png')}}" alt="SurfsideMedia" class="logo__image d-block" />
            </a>
          </div>
          <p class="footer-address">123 Beach Avenue, Surfside City, CA 00000</p>
          <p class="m-0"><strong class="fw-medium">contact@surfsidemedia.in</strong></p>
          <p><strong class="fw-medium">+1 000-000-0000</strong></p>

          <ul class="flex-wrap mb-0 social-links list-unstyled d-flex">
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_facebook" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_twitter" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_instagram" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_pinterest" width="14" height="15" viewBox="0 0 14 15"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_pinterest" />
                </svg>
              </a>
            </li>
          </ul>
        </div>

        <div class="mb-4 footer-column footer-menu mb-lg-0">
          <h6 class="sub-menu__title text-uppercase">Company</h6>
          <ul class="sub-menu__list list-unstyled">
            <li class="sub-menu__item"><a href="{{route('home.about-us')}}" class="menu-link menu-link_us-s">About Us</a></li>
            <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Careers</a></li>
            <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Affiliates</a></li>
            <li class="sub-menu__item"><a href="{{route('home.contact')}}" class="menu-link menu-link_us-s">Contact Us</a></li>
          </ul>
        </div>

        <div class="mb-4 footer-column footer-menu mb-lg-0">
          <h6 class="sub-menu__title text-uppercase">Shop</h6>
          <ul class="sub-menu__list list-unstyled">
            @foreach ($products as $product )
            <li class="sub-menu__item"><a href="{{ route('shop.product.view',['slug'=>$product->slug])}}" class="menu-link menu-link_us-s">{{$product->name}}</a></li>

            @endforeach
            <li class="sub-menu__item"><a href="{{route('shop.index')}}" class="menu-link menu-link_us-s">Shop All</a></li>
          </ul>
        </div>

        <div class="mb-4 footer-column footer-menu mb-lg-0">
          <h6 class="sub-menu__title text-uppercase">Help</h6>
          <ul class="sub-menu__list list-unstyled">
            <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Customer Service</a></li>
            <li class="sub-menu__item"><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">My Account</a>
            </li>

            <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Legal & Privacy</a></li>
            <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Gift Card</a></li>
          </ul>
        </div>

        <div class="mb-4 footer-column footer-menu mb-lg-0">
          <h6 class="sub-menu__title text-uppercase">Categories</h6>
          <ul class="sub-menu__list list-unstyled">
            @foreach ($categories as $category )
              <li class="sub-menu__item"><a href="{{route('shop.index',['categories'=>$category->id])}}" class="menu-link menu-link_us-s">{{$category->name}}</a></li>
            @endforeach
            <li class="sub-menu__item"><a href="{{route('shop.index')}}" class="menu-link menu-link_us-s">Shop All</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container d-md-flex align-items-center">
        <span class="footer-copyright me-auto">©2024 Surfside Media</span>
        <div class="footer-settings d-md-flex align-items-center">
          <a href="">Privacy Policy</a> &nbsp;|&nbsp; <a href="">Terms &amp;
            Conditions</a>
        </div>
      </div>
    </div>
  </footer>


  <footer class="container px-5 footer-mobile w-100 d-md-none bg-body">
    <div class="text-center row">
      <div class="col-4">
        <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
          <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_home" />
          </svg>
          <span>Home</span>
        </a>
      </div>

      <div class="col-4">
        <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
          <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_hanger" />
          </svg>
          <span>Shop</span>
        </a>
      </div>

      <div class="col-4">
        <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
          <div class="position-relative">
            <svg class="d-block" width="18" height="18" viewBox="0 0 20 20" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_heart" />
            </svg>
            <span class="wishlist-amount d-block position-absolute js-wishlist-count">3</span>
          </div>
          <span>Wishlist</span>
        </a>
      </div>
    </div>
  </footer>
