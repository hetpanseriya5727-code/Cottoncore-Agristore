<?php
require_once 'config.php';
$page_title = 'Home - ' . SITE_NAME;
include 'includes/header.php';
?>

      <!-- Hero Banner Section -->
      <section class="hero-banner" style="background: linear-gradient(to right, rgba(128, 181, 1, 0.6), transparent), url('assets/imgs/cotton/banner1.jpg'); background-size: cover; background-position: center; min-height: 80vh; display: flex; align-items: center;">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6">
                  <div class="hero-content" style="max-width: 600px; padding: 40px; background: rgba(0,0,0,0.4); border-radius: 15px; backdrop-filter: blur(5px);">
                     <div style="border-left: 4px solid #80B501; padding-left: 20px; margin-bottom: 30px;">
                        <span style="color: #80B501; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: block; margin-bottom: 10px;">Premium Agriculture</span>
                        <h1 style="font-size: 3.2rem; font-weight: 800; margin: 0; line-height: 1.1; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Premium Quality<br><span style="color: #80B501; font-weight: 700;">Cotton Seeds</span></h1>
                     </div>
                     <p style="font-size: 1.1rem; margin-bottom: 35px; line-height: 1.7; color: rgba(255,255,255,0.95); font-weight: 400; max-width: 500px;">Transform your farming with our certified cotton seeds. Trusted by thousands of farmers across India for superior quality and exceptional yields.</p>
                     <div class="hero-buttons" style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <a href="product.php" class="btn" style="background: linear-gradient(135deg, #80B501, #6a9b01); color: white; padding: 16px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(128, 181, 1, 0.3); text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">Shop Now <i class="fas fa-arrow-right"></i></a>
                        <a href="contact.php" class="btn" style="border: 2px solid white; background: rgba(255,255,255,0.1); color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; backdrop-filter: blur(5px); text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">Contact Us <i class="fas fa-phone"></i></a>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </section>

      <!-- Featured Products Section -->
      <section class="featured-products" style="padding: 100px 0; background: white;">
         <div class="container">
            <div class="text-center mb-5">
               <span style="color: #80B501; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: block; margin-bottom: 15px;">Premium Collection</span>
               <h2 style="font-size: 2.8rem; font-weight: 700; color: #2c3e50; margin: 0 0 20px 0; line-height: 1.2;">Featured <span style="color: #80B501;">Products</span></h2>
               <p style="color: #6c757d; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.6;">Discover our premium collection of certified cotton seeds and agricultural products trusted by farmers nationwide</p>
            </div>
            <div class="discount-main p-relative">
               <div class="discount-slider-navigation furniture__navigation">
                  <button type="button" class="discount-slider-button-prev"><i class="fa-regular fa-angle-left"></i>
                  </button>
                  <button type="button" class="discount-slider-button-next"><i
                        class="fa-regular fa-angle-right"></i></button>
               </div>
               <div class="row align-items-center">
                  <div class="col-xxl-12">
                     <div class="swiper furuniture-active">
                        <div class="swiper-wrapper">
                           <?php
                           // Get featured products from database
                           try {
                               $featured_products = $pdo->query("SELECT * FROM products WHERE status = 'active' AND is_featured = 1 ORDER BY created_at DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
                               // If no featured products, get first 8 active products
                               if (empty($featured_products)) {
                                   $featured_products = $pdo->query("SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
                               }
                           } catch (Exception $e) {
                               // Fallback if is_featured column doesn't exist
                               $featured_products = $pdo->query("SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
                           }
                           
                           foreach ($featured_products as $product): ?>
                           <div class="swiper-slide">
                              <div class="product-item furniture__product">
                                 <?php if ($product['sale_price']): ?>
                                 <div class="product-badge">
                                    <span class="product-trending">Sale</span>
                                 </div>
                                 <?php endif; ?>
                                 <div class="product-thumb theme-bg-2">
                                    <a href="product-details.php?id=<?php echo $product['id']; ?>">
                                       <img src="<?php echo getProductImagePath($product['image']); ?>" alt="<?php echo $product['name']; ?>">
                                    </a>

                                 </div>
                                 <div class="product-content">
                                    <h4 class="product-title">
                                       <a href="product-details.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a>
                                    </h4>
                                    <div class="user-rating">
                                       <i class="fal fa-star"></i>
                                       <i class="fal fa-star"></i>
                                       <i class="fal fa-star"></i>
                                       <i class="fal fa-star"></i>
                                       <i class="fal fa-star"></i>
                                    </div>
                                    <div class="product-price">
                                       <?php if ($product['sale_price']): ?>
                                       <span class="product-new-price"><?php echo formatPrice($product['sale_price']); ?></span>
                                       <span class="product-old-price"><?php echo formatPrice($product['price']); ?></span>
                                       <?php else: ?>
                                       <span class="product-new-price"><?php echo formatPrice($product['price']); ?></span>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Top sale area end -->



      <!-- About Section -->
      <section class="about-section" style="padding: 120px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); position: relative; overflow: hidden;">
         <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(128, 181, 1, 0.1); border-radius: 50%; z-index: 1;"></div>
         <div style="position: absolute; bottom: -100px; left: -100px; width: 300px; height: 300px; background: rgba(44, 62, 80, 0.05); border-radius: 50%; z-index: 1;"></div>
         <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center">
               <div class="col-lg-6 mb-5 mb-lg-0">
                  <div class="about-content">
                     <span style="color: #80B501; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: block; margin-bottom: 15px;">About CottonCore</span>
                     <h2 style="font-size: 2.8rem; font-weight: 700; color: #2c3e50; margin: 0 0 30px 0; line-height: 1.2;">Leading Cotton Seed Provider in <span style="color: #80B501;">India</span></h2>
                     <p style="font-size: 1.1rem; color: #6c757d; line-height: 1.8; margin-bottom: 40px;">CottonCore Agristore has been serving farmers across India for over 15 years, providing premium quality cotton seeds and agricultural products. Our commitment to excellence has made us a trusted partner for thousands of farmers.</p>
                     <div class="features-list" style="margin-bottom: 40px;">
                        <div style="display: flex; align-items: center; margin-bottom: 20px; padding: 15px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                           <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                              <i class="fas fa-seedling" style="color: white; font-size: 20px;"></i>
                           </div>
                           <div>
                              <h6 style="margin: 0; color: #2c3e50; font-weight: 600;">Premium Quality Seeds</h6>
                              <p style="margin: 0; color: #6c757d; font-size: 14px;">Certified and tested for maximum yield</p>
                           </div>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 20px; padding: 15px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                           <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                              <i class="fas fa-user-tie" style="color: white; font-size: 20px;"></i>
                           </div>
                           <div>
                              <h6 style="margin: 0; color: #2c3e50; font-weight: 600;">Expert Agricultural Guidance</h6>
                              <p style="margin: 0; color: #6c757d; font-size: 14px;">Professional support from our experts</p>
                           </div>
                        </div>
                        <div style="display: flex; align-items: center; padding: 15px; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                           <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                              <i class="fas fa-shipping-fast" style="color: white; font-size: 20px;"></i>
                           </div>
                           <div>
                              <h6 style="margin: 0; color: #2c3e50; font-weight: 600;">Nationwide Delivery</h6>
                              <p style="margin: 0; color: #6c757d; font-size: 14px;">Fast and secure delivery across India</p>
                           </div>
                        </div>
                     </div>
                     <a href="about.php" style="background: linear-gradient(135deg, #80B501, #6a9b01); color: white; padding: 15px 35px; border-radius: 50px; text-decoration: none; font-weight: 600; display: inline-block; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(128, 181, 1, 0.3);">Learn More <i class="fas fa-arrow-right" style="margin-left: 10px;"></i></a>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="about-image" style="position: relative;">
                     <div style="background: white; padding: 20px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                        <img src="assets/imgs/cotton/banner1.png" alt="About CottonCore" style="width: 100%; border-radius: 15px; display: block;">
                     </div>
                     <div style="position: absolute; top: 30px; right: 30px; background: #80B501; color: white; padding: 20px; border-radius: 15px; text-align: center; box-shadow: 0 10px 30px rgba(128, 181, 1, 0.3);">
                        <h4 style="margin: 0; font-size: 2rem; font-weight: 700;">15+</h4>
                        <p style="margin: 0; font-size: 14px; opacity: 0.9;">Years Experience</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Testimonials Section -->
      <section class="testimonials-section" style="padding: 120px 0; background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); position: relative; overflow: hidden;">
         <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="testimonial-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="2" fill="%2380B501" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23testimonial-pattern)"/></svg>'); z-index: 1;"></div>
         <div class="container" style="position: relative; z-index: 2;">
            <div class="text-center mb-5">
               <span style="color: #80B501; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: block; margin-bottom: 15px;">Customer Reviews</span>
               <h2 style="font-size: 2.8rem; font-weight: 700; color: white; margin: 0 0 20px 0; line-height: 1.2;">What Our <span style="color: #80B501;">Farmers</span> Say</h2>
               <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.6;">Real feedback from farmers who trust CottonCore for their agricultural needs and have experienced exceptional results</p>
            </div>
            <div class="row">
               <div class="col-lg-6 mb-4">
                  <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 40px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); position: relative;">
                     <div style="display: flex; align-items: center; margin-bottom: 25px;">
                        <div style="width: 60px; height: 60px; background: #80B501; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                           <span style="color: white; font-weight: 700; font-size: 20px;">RP</span>
                        </div>
                        <div>
                           <h6 style="color: white; font-weight: 600; margin: 0 0 5px 0; font-size: 16px;">Rajesh Patel</h6>
                           <span style="color: #80B501; font-size: 14px; font-weight: 500;">Farmer, Gujarat</span>
                           <div style="margin-top: 8px;">
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                           </div>
                        </div>
                     </div>
                     <p style="color: rgba(255,255,255,0.9); font-style: italic; line-height: 1.7; margin: 0; font-size: 15px;">"CottonCore seeds have significantly improved my crop yield. The quality is exceptional and their support team is always helpful. I've been using their products for 3 years now."</p>
                     <div style="position: absolute; top: 15px; right: 20px; color: rgba(128, 181, 1, 0.3); font-size: 40px;">
                        <i class="fas fa-quote-right"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 mb-4">
                  <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 40px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); position: relative;">
                     <div style="display: flex; align-items: center; margin-bottom: 25px;">
                        <div style="width: 60px; height: 60px; background: #80B501; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                           <span style="color: white; font-weight: 700; font-size: 20px;">SK</span>
                        </div>
                        <div>
                           <h6 style="color: white; font-weight: 600; margin: 0 0 5px 0; font-size: 16px;">Suresh Kumar</h6>
                           <span style="color: #80B501; font-size: 14px; font-weight: 500;">Farmer, Maharashtra</span>
                           <div style="margin-top: 8px;">
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                           </div>
                        </div>
                     </div>
                     <p style="color: rgba(255,255,255,0.9); font-style: italic; line-height: 1.7; margin: 0; font-size: 15px;">"Best cotton seeds in the market! Fast delivery and excellent customer service. Highly recommended for all farmers. The yield has increased by 40%."</p>
                     <div style="position: absolute; top: 15px; right: 20px; color: rgba(128, 181, 1, 0.3); font-size: 40px;">
                        <i class="fas fa-quote-right"></i>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 40px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.2); position: relative; max-width: 800px; margin: 0 auto;">
                     <div style="display: flex; align-items: center; margin-bottom: 25px;">
                        <div style="width: 60px; height: 60px; background: #80B501; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
                           <span style="color: white; font-weight: 700; font-size: 20px;">AS</span>
                        </div>
                        <div>
                           <h6 style="color: white; font-weight: 600; margin: 0 0 5px 0; font-size: 16px;">Amit Singh</h6>
                           <span style="color: #80B501; font-size: 14px; font-weight: 500;">Farmer, Rajasthan</span>
                           <div style="margin-top: 8px;">
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                              <i class="fas fa-star" style="color: #ffc107; margin-right: 3px; font-size: 14px;"></i>
                           </div>
                        </div>
                     </div>
                     <p style="color: rgba(255,255,255,0.9); font-style: italic; line-height: 1.7; margin: 0; font-size: 15px;">"Trusted CottonCore for 5 years now. Their seeds never disappoint and the prices are very reasonable. The technical support team is knowledgeable and always ready to help with farming techniques."</p>
                     <div style="position: absolute; top: 15px; right: 20px; color: rgba(128, 181, 1, 0.3); font-size: 40px;">
                        <i class="fas fa-quote-right"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- Why Choose Us Section -->
      <section class="why-choose-section" style="padding: 120px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
         <div class="container">
            <div class="text-center mb-5">
               <span style="color: #80B501; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display: block; margin-bottom: 15px;">Our Advantages</span>
               <h2 style="font-size: 2.8rem; font-weight: 700; color: #2c3e50; margin: 0 0 20px 0; line-height: 1.2;">Why Farmers Trust <span style="color: #80B501;">CottonCore</span></h2>
               <p style="color: #6c757d; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.6;">Discover what makes us the preferred choice for thousands of farmers across India with our commitment to quality and excellence</p>
            </div>
            <div class="row">
               <div class="col-lg-4 col-md-6 mb-4">
                  <div style="background: white; padding: 50px 30px; border-radius: 20px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1); height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;">
                     <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(135deg, #80B501, #6a9b01);"></div>
                     <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px auto; box-shadow: 0 10px 30px rgba(128, 181, 1, 0.3);">
                        <i class="fas fa-certificate" style="color: white; font-size: 35px;"></i>
                     </div>
                     <h4 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px; font-size: 1.4rem;">Certified Quality</h4>
                     <p style="color: #6c757d; line-height: 1.8; margin: 0;">All our seeds are certified and tested for quality assurance. We maintain strict quality control standards to ensure maximum yield.</p>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 mb-4">
                  <div style="background: white; padding: 50px 30px; border-radius: 20px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1); height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;">
                     <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(135deg, #80B501, #6a9b01);"></div>
                     <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px auto; box-shadow: 0 10px 30px rgba(128, 181, 1, 0.3);">
                        <i class="fas fa-shipping-fast" style="color: white; font-size: 35px;"></i>
                     </div>
                     <h4 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px; font-size: 1.4rem;">Fast Delivery</h4>
                     <p style="color: #6c757d; line-height: 1.8; margin: 0;">Quick and reliable delivery across India. We ensure your seeds reach you in perfect condition and on time with secure packaging.</p>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 mb-4">
                  <div style="background: white; padding: 50px 30px; border-radius: 20px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.1); height: 100%; transition: all 0.3s ease; position: relative; overflow: hidden;">
                     <div style="position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(135deg, #80B501, #6a9b01);"></div>
                     <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #80B501, #6a9b01); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px auto; box-shadow: 0 10px 30px rgba(128, 181, 1, 0.3);">
                        <i class="fas fa-headset" style="color: white; font-size: 35px;"></i>
                     </div>
                     <h4 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px; font-size: 1.4rem;">Expert Support</h4>
                     <p style="color: #6c757d; line-height: 1.8; margin: 0;">Our agricultural experts provide guidance and support to help you achieve maximum crop yield and quality throughout the season.</p>
                  </div>
               </div>
            </div>
         </div>
      </section>

<?php include 'includes/footer.php'; ?>