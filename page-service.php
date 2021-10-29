<?php get_header();?>
<!--MAIN BANNER AREA START -->
    <div class="page-banner-area page-service" id="page-banner">
      <div class="overlay dark-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
            <div class="banner-content content-padding">
              <h1 class="text-white"><?php the_title();?></h1>
              <p>Мы оказываем весь спект диджитал услуг</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--MAIN HEADER AREA END -->

    <?php the_content();?>

        <!--  SERVICE PARTNER START  -->
        <section id="service-head" class="service-style-two">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-sm-12 m-auto">
                <div class="heading text-white text-center">
                  <h4 class="section-title text-white">Диджитал полного цикла</h4>
              <p>
                Это означает, что мы сможем выполнить любую цифровую задачу: <br />
                видео, маркетинг, реклама, разработка или дизайн.
              </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--  SERVICE PARTNER END  -->
        <!--  SERVICE AREA START  -->
    <section id="service">
      <div class="container">
        <div class="row">
          <?php
          global $post;

          $query = new WP_Query( [
            'posts_per_page' => 6,
            'post_type'      => 'services',
          ] );

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
              $query->the_post();
              ?>
                <div class="service-item col-lg-4 col-sm-6 col-md-6">
                  <div class="service-box">
                    <div class="service-img-icon">
                      <img src="<?php echo get_the_post_thumbnail_url();?>" alt="service-icon" class="img-fluid" />
                    </div>
                    <div class="service-inner">
                      <h4><?php the_title();?></h4>
                      <p>
                        <?php the_excerpt(); ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php
            }
          } else {
            ?>
            <p>Постов еще нет</p>
            <?php
          }

          wp_reset_postdata(); // Сбрасываем $post
          ?>

        </div>
      </div>
    </section>
    <!--  SERVICE AREA END  -->

        <!--  PARTNER START  -->
    <section class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 text-center text-lg-left">
            <div class="mb-5">
              <h3 class="mb-2">Эти компании доверяют нам</h3>
              <p>Компании, с которыми мы работаем давно</p>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
          global $post;

          $query = new WP_Query( [
            'posts_per_page' => 4,
            'post_type'      => 'partners',
          ] );

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
              $query->the_post();
              ?>
              <div class="col-lg-3 col-sm-6 col-md-3 text-center">
            <img src="<?php echo get_the_post_thumbnail_url();?>" alt="partner" class="img-fluid" />
              </div>
              <?php
            }
          } else {
            ?>
            <p>Постов еще нет</p>
            <?php
          }
          wp_reset_postdata(); // Сбрасываем $post
          ?>
        </div>
      </div>
    </section>
    <!--  PARTNER END  -->
<?php get_footer();?>