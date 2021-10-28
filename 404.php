<?php get_header(); ?>

    <!--MAIN BANNER AREA START -->
    <div class="banner-area banner-3">
      <div class="overlay dark-overlay"></div>
      <div class="d-table">
        <div class="d-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                  <h5 class="subtitle bg-danger">Ошибка 404</h5>
                  <h1 class="banner-title">Такой страницы не&nbspсуществует</h1>
                  <p>
                    Данной страницы не существует. Возможно адрес страницы был изменен или вы ввели не верный адрес.
                  </p>
									<?php the_widget('WP_Widget_Search'); ?>
                  <a href="#" class="btn btn-white btn-circled">Перейти на главную</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--MAIN HEADER AREA END -->

<?php get_footer(); ?>