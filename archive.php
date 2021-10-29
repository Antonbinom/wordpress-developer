<?php get_header();?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">
											<?php
												if (is_category()){
													echo __('<small>Рубрика </small><br>') . get_queried_object()->name;
												}
												if (is_tag()){
													echo __('<small>Записи с меткой </small><br>') . get_queried_object()->name;
												}
												if (is_author()){
													echo __('<small>Записи автора </small><br>') . get_the_author_meta('display_name');
												}
												if (is_date()){
													echo __('<small>Архив по дате </small><br>') . get_the_date('j F Y');
												}
											?>
										</h1>
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
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="h6 text-uppercase"><?php the_author(); ?></a>
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
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" class="h6 text-uppercase"><?php the_author(); ?></a>
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
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer();?>