<?php get_header();?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="banner-content content-padding">
                    <h1 class="text-white"><?php the_title(); ?></h1>
                    <p>Поисковая выдача — это всегда конкуренция. Но что делать, чтобы конкуренты остались позади вас? Отвечаю в статье</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <main class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">

                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', get_post_type() );
                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wp_dev' ) . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wp_dev' ) . '</span> <span class="nav-title">%title</span>',
                                )
                            );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>

                            <div class="comments my-4">
                                <h3 class="mb-5">Комментарии:</h3>

                                <div class="media mb-4">
                                    <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                    <div class="media-body">
                                        <h5>Антон Колесников</h5>
                                        <span class="text-muted">20 января 2020</span>
                                        <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

                                        <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>

                                        <div class="media mt-5">
                                            <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                            <div class="media-body">
                                                <h5>Егор Савицкий</h5>
                                                <span class="text-muted">20 января 2020</span>
                                                <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

                                                <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media mb-4">
                                    <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                    <div class="media-body">
                                        <h5>Валентин Крашков</h5>
                                        <span class="text-muted">14 февраля 2020</span>
                                        <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

                                        <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 mb-3">
                                <h3 class="mt-5 mb-2">Оставьте комментарий</h3>
                                <p class="mb-4">Ваш E-mail защищен от спама</p>
                                <form action="#" class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <textarea cols="30" rows="6" class="form-control"  placeholder="Комментарий"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" placeholder="Имя">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <a href="#" class="btn btn-hero btn-circled">Оставить комментарий</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </main>
            <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
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
    </div>
</section>
<?php get_footer();?>