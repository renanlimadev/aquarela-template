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
        <footer class="container-fluid border-footer bg-white text-white pt-5" role="contentinfo">
            <div class="row mt-1 px-1">
                <div class="col-md-4 pt-1 pb-2 pl-2">
                    <div class="row text-center">
                        <div class="col-12">
                            <a class="footer-brand img-fluid pb-2" href="<?php esc_url(home_url('/'));?>"><img src="<?php bloginfo('template_url');?>/assets/icons/aquarela-logo.svg" alt="Logomarca para rodapé"/></a>
                        </div>
                    </div>
                    <div class="row text-center py-3">
                        <div class="col-12">
                            <h4 class="title-footer font-weight-bold">Nos siga nas redes sociais</h4>                    
                            <ul class="nav social-navbar justify-content-center">
                                <li class="nav-item"><a class="nav-link facebook" href="https://www.facebook.com/AquarelaKidsStore/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                                <li class="nav-item"><a class="nav-link instagram" href="https://www.instagram.com/aquarelakidsstore/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li class="nav-item"><a class="nav-link whatsapp" href="https://wa.me/5541987602324" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-2 p-1 pl-2">
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
                <div class="col-md-4 pt-1 pb-1 pl-2">
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
            <div class="row py-3 row-enterprise">
                <div class="col-md-4">
                    <p class="py-1 empresa">AQUARELA COMERCIO DE VESTUARIOS E ACESSOIOS EIRELI ME - 21.865.842/0002-67 | Av. Nossa Senhora de Lourdes, 63 - Jardim das Américas, Curitiba/PR</p>
                    <p class="py-1 empresa">Contato:<br/>E-mail: contato@aquarelastore.com.br<br/>Telefone: (41) 3311-1689<br/>WhatsApp: +55 41 98760-2324</p>
                </div>
                <div class="col-md-5">

                </div>
                <div class="col-md-3 encrypt my-auto">
                    <div class="row text-center align-items-center">
                        <a class="img-fluid" href="https://letsencrypt.org/pt-br/" terget="_blank"><img src="<?php bloginfo('template_url')?>/assets/icons/lets-encrypt.svg" alt="Certificado de segurança Let's Encrypt"/></a>
                    </div>
                </div>
            </div>
            <div class="row py-2 bg-aqua">
                <div class="col-md-6 text-center pt-1">
                    <h6 class="copy-title">&copy; 2020. Todos os direitos reservados</h6>
                </div>
                <div class="col-md-6 text-center pt-1">
                    <h6 class="dev-title"><span class="mt-1">Criado com carinho por</span>&nbsp;<a class="dev-logo" href="https://renandev.com.br">RenanDev</a></h6>
                </div>
            </div>
        </footer>
        <?php wp_footer();?>
    </body>
</html>
