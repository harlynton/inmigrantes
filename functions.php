<?php 
    //Consultas reutilizabes:
    require get_template_directory() .'/inc/queries.php';

    //Cuando el tema se activa: 
    function inmigrantes_setup(){
        //Habilitar imagenes destacadas:
        add_theme_support('post-thumbnails');

        //agregar tamaños de imagen personalizados:
        add_image_size( 'square', 350, 350, true );
        add_image_size( 'portrait', 400, 720, true );
        add_image_size( 'clasesCard', 700, 400, true );
    }
    add_action('after_setup_theme','inmigrantes_setup');

    function inmigrantes_menus(){
        register_nav_menus( array(
            'menu-principal' => __('Menu Principal','inmigrantes')
        ));
    }

    add_action('init','inmigrantes_menus');

    //Scripts & Styles
    function inmigrantes_scripts_styles(){
        wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css',array(),'8.0.1');
        wp_enqueue_style('slicknavCSS', get_template_directory_uri().'/css/slicknav.min.css',array(),'1.0.0');
        wp_enqueue_style('googleFont', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;800;900&family=Rubik:ital,wght@0,500;0,600;0,800;0,900;1,400&display=swap', array(), null);

        if(is_page('galeria')):
            wp_enqueue_style('lightboxCSS', get_template_directory_uri().'/css/lightbox.min.css',array(),'2.11.3');
        endif;    

        if(is_page('contacto')):
            wp_enqueue_style('leafletCSS', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), '1.7.1');
        endif;

        wp_enqueue_style('style', get_stylesheet_uri(),array('normalize','googleFont'),'1.0.0');

        wp_enqueue_script('slicknavJS', get_template_directory_uri().'/js/jquery.slicknav.min.js', array('jquery'), '1.0.0', true);

        if(is_page('galeria')):
            wp_enqueue_script('LightboxJS', get_template_directory_uri().'/js/lightbox.min.js', array('jquery'), '2.11.3', true);
        endif;

        if(is_page('contacto')):
            wp_enqueue_script('LeafletJS', "https://unpkg.com/leaflet@1.7.1/dist/leaflet.js", array(), '1.7.1', true);
        endif;
        
        wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js', array('jquery','slicknavJS'), '1.0.0', true);
    }

    add_action('wp_enqueue_scripts','inmigrantes_scripts_styles');

    //Zona de widgets

    function inmigrantes_widgets(){
        register_sidebar(array(
            'name' => 'Sidebar 1',
            'id' => 'sidebar_1',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' =>'<h3 class="text-center texto-primario">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => 'Sidebar 2',
            'id' => 'sidebar_2',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' =>'<h3 class="text-center texto-primario">',
            'after_title' => '</h3>'
        ));
    }
    add_action('widgets_init', 'inmigrantes_widgets');

    /**Imagen Hero inicio: **/

    function inmigrantes_hero_image(){
        // obtener ID pagina ppal:
        $front_page_id = get_option('page_on_front');
        //Obtener ID imagen:
        $id_imagen = get_field('imagen_hero',$front_page_id);
        //Obtener imagen:
        $imagen = wp_get_attachment_image_src($id_imagen,'full')[0];

        //Style CSS:
        wp_register_style('custom',false);
        wp_enqueue_style('custom');

        //Poner CSS dentro de PHP:
        $imagen_destacada_css="
            body.home .site-header{
                background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url($imagen);
            }
        ";

        //Agregar estilos en linea:
        wp_add_inline_style('custom', $imagen_destacada_css);
    }
    add_action('init','inmigrantes_hero_image');

?>