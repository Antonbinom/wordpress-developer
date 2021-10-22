<?php get_header(); ?>

<?php get_header();?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white"><?php printf( esc_html__( 'Результаты поиска по&nbsp;запросу: %s', 'band-digital' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php $count = 0; // объявляю счетчик
                    //цикл проверяет есть ли посты, если есть выодит пока не выведет 5 штук
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $count++; // увеличиваю счетчик на 1 после вывода поста
                    switch($count) {
                        case "3": ?>
                        <div class="col-lg-12">
                            <div class="blog-post">
                                <?php
                                // выводит картинку поста если она есть
                                //должно находится внутри цикла
                                if( has_post_thumbnail() ) { // проверяем есть ли миниатюра
                                    the_post_thumbnail( 'post-thumbnail', array('class' => "img-fluid w-100 wide")); // выводим миниатюру
                                }
                                // если нет, выводит мин иатюру-заглушка
                                else {
                                    echo '<img class="img-fluid w-100 wide" src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" />';
                                }
                                ?>
                                <div class="mt-4 mb-3 d-flex">
                                    <div class="post-author mr-3">
                                        <i class="fa fa-user"></i>
                                        <!-- Выводим имя автора -->
                                        <span class="h6 text-uppercase"><?php the_author(); ?></span>
                                    </div>

                                    <div class="post-info">
                                        <i class="fa fa-calendar-check"></i>
                                        <!-- Выводим дату в формате день, месяц, год -->
                                        <span><?php the_time('j F Y')?></span>
                                    </div>
                                </div>
                                <!-- Выводим ссылку -->
                                <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title();?></a>
                                <!-- Выводим отрывок статьи -->
                                <p class="mt-3"><?php the_excerpt();?></p>
                                <!-- Выводим ссылку -->
                                <a href="<?php echo get_the_permalink(); ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <?php
                        break;
                        default: ?>
                        <div class="col-lg-6">
                            <div class="blog-post">
                                <?php
                                // выводит картинку поста если она есть
                                //должно находится внутри цикла
                                if( has_post_thumbnail() ) { // проверяем есть ли миниатюра
                                    the_post_thumbnail( 'medium', array('class' => "img-fluid w-100")); // выводим миниатюру
                                }
                                // если нет, выводит миниатюру-заглушка
                                else {
                                    echo '<img class="img-fluid w-100" src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" />';
                                }
                                ?>
                                <div class="mt-4 mb-3 d-flex">
                                    <div class="post-author mr-3">
                                        <i class="fa fa-user"></i>
                                        <!-- Выводим имя автора -->
                                        <span class="h6 text-uppercase"><?php the_author(); ?></span>
                                    </div>

                                    <div class="post-info">
                                        <i class="fa fa-calendar-check"></i>
                                        <!-- Выводим дату в формате день, месяц, год -->
                                        <span><?php the_time('j F Y')?></span>
                                    </div>
                                </div>
                                <!-- Выводим ссылку -->
                                <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title();?></a>
                                <!-- Выводим отрывок статьи -->
                                <p class="mt-3"><?php the_excerpt();?></p>
                                <!-- Выводим ссылку -->
                                <a href="<?php echo get_the_permalink(); ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    <?php break; } endwhile; else: ?>
                        Записей нет.
                    <?php endif; ?>
                    <div class="col-12">
                        <?php the_posts_pagination(array(
                        'prev_text'    => __('<span class="p-2 border">« Предыдущие посты</span>'),
                        'next_text'    => __('<span class="p-2 border">Селедующие посты »</span>'),
                        'before_page_number' => '<span class="p-2 border">',
                        'after_page_number' => '</span>',
                        ));
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ( ! dynamic_sidebar('sidebar-blog') ) : dynamic_sidebar( 'sidebar-blog' ); endif; ?>
                        <div class="sidebar-widget search">
                            <div class="form-group">
                                <input type="text" placeholder="поиск" class="form-control">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget about-bar">
                            <h5 class="mb-3">О нас</h5>
                            <p>Мы — маркетинговое агентство полного цикла, которое оказывает диджитал услуги стартапам и крупным компаниям</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget category">
                            <h5 class="mb-3">Рубрики</h5>
                            <ul class="list-styled">
                                <li>Маркетинг</li>
                                <li>Диджитал</li>
                                <li>SEO</li>
                                <li>Веб-дизайн</li>
                                <li>Разработка</li>
                                <li>Видео</li>
                                <li>Подкаст</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget tag">
                            <a href="#">web</a>
                            <a href="#">development</a>
                            <a href="#">seo</a>
                            <a href="#">marketing</a>
                            <a href="#">branding</a>
                            <a href="#">web deisgn</a>
                            <a href="#">Tutorial</a>
                            <a href="#">Tips</a>
                            <a href="#">Design trend</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="sidebar-widget download">
                            <h5 class="mb-4">Полезные файлы</h5>
                            <a href="#"> <i class="fa fa-file-pdf"></i>Презентация Promodise</a>
                            <a href="#"> <i class="fa fa-file-pdf"></i>10 источников бесплатного SEO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>