<?php 
/**
 * 
 * Rodapé principal do template
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */?>
        <footer class="container-fluid bg-aqua-blue text-white pt-5" role="contentinfo">
            <div class="row mt-1 px-1">
                <div class="col-md-6 pt-1 pb-2 pl-2">                    
                        <p class="py-1 empresa">AQUARELA COMERCIO DE VESTUARIOS E ACESSOIOS EIRELI ME<br/>21.865.842/0002-67<br/>Av. Nossa Senhora de Lourdes, 63 - Jardim das Américas, Curitiba/PR</p>
                        <p class="py-1 empresa">Contato:<br/>E-mail: contato@aquarelastore.com.br<br/>Telefone: (41) 3311-1689<br/>WhatsApp: +55 41 98760-2324</p>
                        <h4 class="title-footer font-weight-bold">Nos siga nas redes sociais</h4>
                        <ul class="nav social-navbar">
                            <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/AquarelaKidsStore/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/aquarelakidsstore/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href="https://wa.me/5541987602324" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                        </ul>
                </div>
                <div class="col-md-3 pt-2 p-1 pl-2">
                    <h4 class="title-footer pb-1 font-weight-bold">Sobre a empresa</h4>
                    <?php 
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer1',
                                'container'      => false,
                                'menu_class'     => 'nav flex-column nav-footer1',
                                'menu_id'        => 'footer1',
                                'fallback_cb'    => false
                            )
                        );
                    ?>
                </div>
                <div class="col-md-3 pt-1 pb-1 pl-2">
                    <h4 class="title-footer pb-1 font-weight-bold">Dicas importantes</h4>
                    <?php 
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer2',
                                'container'      => false,
                                'menu_class'     => 'nav flex-column nav-footer2',
                                'menu_id'        => 'footer2',
                                'fallback_cb'    => false
                            )
                        );
                    ?>
                </div>
            </div>
            <div class="row py-3 paymetns-method">
            </div>
            <div class="row py-2">
                <div class="col-md-6 text-center">
                    <h6 class="copy-title">&copy; 2020. Todos os direitos reservados</h6>
                </div>
                <div class="col-md-6 text-center">
                    <h6 class="dev-title"><span class="mt-1">Criado com carinho por</span>&nbsp;<a class="dev-logo" href="https://renandev.com.br"><img class="img-fluid" src="<?php bloginfo('template_url');?>/assets/icons/logo-dev.svg" alt="Link para o site do desenvolvedor"/></a></h6>
                </div>
            </div>
        </footer>
        <?php wp_footer();?>
    </body>
</html>
