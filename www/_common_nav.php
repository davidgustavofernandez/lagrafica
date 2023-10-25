<?php
$nav_section = '';
$id_section_nav = (!empty($id_section) && $id_section == '22') ? '22' : '';
?>
<header>
    <div class="header-area header-gray">
        <div class="main-header header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="content-brand">
                            <a href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>"><img src="<?php echo $setting_logo; ?>" alt="<?php echo $setting_name; ?>"></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="main-menu black-menu menu-bg-white d-none d-lg-block">
                            <div class="hamburger hamburger--collapse">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                            <nav class="hamburger-menu">
                                <ul id="navigation">

                                    <?php
                                    foreach ($static_sections_navs_array as $sections_menu_nav) {
                                        $external_url = strpos($sections_menu_nav['url_canonical'], 'http');

                                        if ($id_section_nav) {
                                            $show_like_cta = !empty($sections_menu_nav['show_like_cta']) ? 'btn btn-primary' : '';
                                        } else {
                                            $show_like_cta = !empty($sections_menu_nav['show_like_cta']) ? 'btn btn-dark' : '';
                                        }

                                        // SECTIONS CHILDS
                                        if (!empty($sections_menu_nav['childs']) && !empty($sections_menu_nav['menu_header']) && $sections_menu_nav['menu_header'] == '1' && $sections_menu_nav['id_setting_language'] == $session_language) {
                                            $section_targuet = !empty($sections_menu_nav['id_section_target']) ? $_f->getStringOffArrayByIndice($static_sections_targets_array, 'id_section_target', $sections_menu_nav['id_section_target'], 'name') : '';

                                            // GA
                                            $ga_str = '';
                                            if (!empty($sections_menu_nav['ga_command']) && !empty($sections_menu_nav['ga_hit']) && !empty($sections_menu_nav['ga_event_category']) && !empty($sections_menu_nav['ga_event_action']) && !empty($sections_menu_nav['ga_event_label'])) {
                                                $ga_str = 'ga-command="' . $sections_menu_nav['ga_command'] . '" ga-hit="' . $sections_menu_nav['ga_hit'] . '" ga-event-category="' . $sections_menu_nav['ga_event_category'] . '" ga-event-action="' . $sections_menu_nav['ga_event_action'] . '" ga-event-label="global nav - ' . $sections_menu_nav['ga_event_label'] . '"';
                                            }

                                            $external_urls = strpos($sections_menu_nav['url_canonical'], 'http');
                                            $dinamic_urls = strpos($sections_menu_nav['url_canonical'], '.php?id');
                                            if (empty($sections_menu_nav['url_canonical'])) {
                                                if ($dinamic_urls !== false) {
                                                    $section_urls = $_f->getCustomUrl(true, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
                                                } else {
                                                    $section_urls = $_f->getCustomUrl(true, '', '', $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                }
                                            } else {
                                                if ($dinamic_urls !== false) {
                                                    $section_urls = $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
                                                } else {
                                                    $section_urls = $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                }
                                            } ?>
                                            <li>
                                                <a class="ga DD <?php echo $show_like_cta; ?>" href="<?php echo $section_urls; ?>" data-url="<?php echo $section_urls; ?>" <?php if (!empty($ga_str)) {
                                                                                                                                                                                echo $ga_str;
                                                                                                                                                                            }; ?>><?php echo $sections_menu_nav['name']; ?></a>
                                                <ul class="submenu">
                                                    <?php
                                                    foreach ($sections_menu_nav['childs'] as $sections_menu_nav_child) {
                                                        if (!empty($sections_menu_nav_child['url_canonical'])) {
                                                            if ($external_url !== false) {
                                                                // echo '1';
                                                                $section_url = $_f->getCustomUrl(false, $sections_menu_nav_child['slug'], $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                            } else {
                                                                // echo '2';
                                                                $url_child = $_f->getCustomUrl(false, $sections_menu_nav_child['slug'], $sections_menu_nav['slug'], $sections_menu_nav_child['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                            }
                                                        } else {
                                                            // echo '3';
                                                            // $url_child = $_f->getCustomUrl(false, $sections_menu_nav_child['slug'], $sections_menu_nav['slug'], "educacion.php?ids=".$sections_menu_nav_child['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
                                                            //  getCustomUrl($friendly, $slug_parent, $slug, $canonical, $anchor, $section = '')
                                                            // echo $sections_menu_nav_child['slug'] . '|' . $sections_menu_nav['slug'] . '|' . $sections_menu_nav_child['url_canonical'] . '|' . $sections_menu_nav['url_anchor' . '|' . $nav_section];
                                                            $url_child = $_f->getCustomUrl(true, $sections_menu_nav['slug'], $sections_menu_nav_child['slug'], $sections_menu_nav_child['url_canonical'], $sections_menu_nav_child['url_anchor'], $nav_section);
                                                            // echo $url_child;
                                                            // public function getCustomUrls($path, $slug, $slug_parent, $url_canonical)
                                                        }

                                                        $targuet_child = !empty($sections_menu_nav_child['id_section_target']) ? $_f->getStringOffArrayByIndice($static_sections_targets_array, 'id_section_target', $sections_menu_nav_child['id_section_target'], 'name') : '';

                                                        // SECTIONS FOR USERS NOT LOGGED
                                                        if (empty($token_session_data_user) || $token_session_data_user == 'sindatos') {
                                                            // SHOW THE SECTIONS THAT THE USER CAN SEE WITHOUT BEING LOGGED
                                                            if (empty($sections_menu_nav_child['need_logged'])) {
                                                                // GA
                                                                $ga_str = '';
                                                                if (!empty($sections_menu_nav_child['ga_command']) && !empty($sections_menu_nav_child['ga_hit']) && !empty($sections_menu_nav_child['ga_event_category']) && !empty($sections_menu_nav_child['ga_event_action']) && !empty($sections_menu_nav_child['ga_event_label']) && !empty($sections_menu_nav['ga_event_label'])) {
                                                                    $ga_str = 'ga-command="' . $sections_menu_nav_child['ga_command'] . '" ga-hit="' . $sections_menu_nav_child['ga_hit'] . '" ga-event-category="' . $sections_menu_nav_child['ga_event_category'] . '" ga-event-action="' . $sections_menu_nav_child['ga_event_action'] . '" ga-event-label="global nav - ' . $sections_menu_nav['ga_event_label'] . ' - ' . $sections_menu_nav_child['name'] . '"';
                                                                } ?>
                                                                <li><a class="dropdown-item ga DDA" href="<?php echo $url_child; ?>" <?php if (!empty($targuet_child)) {
                                                                                                                                            echo 'target="' . $targuet_child . '"';
                                                                                                                                        } ?> <?php if (!empty($ga_str)) {
                                                                                                                                                    echo $ga_str;
                                                                                                                                                }; ?>><?php echo $sections_menu_nav_child['name']; ?></a></li>
                                                            <?php
                                                            }
                                                        } else {
                                                            // SHOW ALL SECTIONS IF THE USER IS LOGGED
                                                            // GA
                                                            $ga_str = '';
                                                            if (!empty($sections_menu_nav_child['ga_command']) && !empty($sections_menu_nav_child['ga_hit']) && !empty($sections_menu_nav_child['ga_event_category']) && !empty($sections_menu_nav_child['ga_event_action']) && !empty($sections_menu_nav_child['ga_event_label']) && !empty($sections_menu_nav['ga_event_label'])) {
                                                                $ga_str = 'ga-command="' . $sections_menu_nav_child['ga_command'] . '" ga-hit="' . $sections_menu_nav_child['ga_hit'] . '" ga-event-category="' . $sections_menu_nav_child['ga_event_category'] . '" ga-event-action="' . $sections_menu_nav_child['ga_event_action'] . '" ga-event-label="global nav - ' . $sections_menu_nav['ga_event_label'] . ' - ' . $sections_menu_nav_child['name'] . '"';
                                                            } ?>
                                                            <li><a class="dropdown-item ga DDB" href="<?php echo $url_child; ?>" <?php if (!empty($targuet_child)) {
                                                                                                                                        echo 'target="' . $targuet_child . '"';
                                                                                                                                    } ?> <?php if (!empty($ga_str)) {
                                                                                                                                                echo $ga_str;
                                                                                                                                            }; ?>><?php echo $sections_menu_nav_child['name']; ?></a></li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        } elseif (!empty($sections_menu_nav['menu_header']) && $sections_menu_nav['menu_header'] == '1') {
                                            $external_url = strpos($sections_menu_nav['url_canonical'], 'http');
                                            $dinamic_url = strpos($sections_menu_nav['url_canonical'], '.php?id');

                                            // SECTIONS PARENT
                                            if (empty($sections_menu_nav['url_canonical'])) {
                                                if ($dinamic_url !== false) {
                                                    $section_url = $_f->getCustomUrl(true, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
                                                } else {
                                                    $section_url = $_f->getCustomUrl(true, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                }
                                            } else {
                                                if ($dinamic_url !== false) {
                                                    $section_url = $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'] . $sections_menu_nav['id_section'], $sections_menu_nav['url_anchor'], $nav_section);
                                                } else {
                                                    $section_url = $_f->getCustomUrl(false, '', $sections_menu_nav['slug'], $sections_menu_nav['url_canonical'], $sections_menu_nav['url_anchor'], $nav_section);
                                                }
                                            }
                                            $section_targuet = !empty($sections_menu_nav['id_section_target']) ? $_f->getStringOffArrayByIndice($static_sections_targets_array, 'id_section_target', $sections_menu_nav['id_section_target'], 'name') : '';

                                            // SHOW THE SECTIONS THAT THE USER CAN SEE WITHOUT BEING LOGGED
                                            if (empty($token_session_data_user) || $token_session_data_user == 'sindatos') {
                                                if (empty($sections_menu_nav['need_logged'])) {
                                                    // GA
                                                    $ga_str = '';
                                                    if (!empty($sections_menu_nav['ga_command']) && !empty($sections_menu_nav['ga_hit']) && !empty($sections_menu_nav['ga_event_category']) && !empty($sections_menu_nav['ga_event_action']) && !empty($sections_menu_nav['ga_event_label'])) {
                                                        $ga_str = 'ga-command="' . $sections_menu_nav['ga_command'] . '" ga-hit="' . $sections_menu_nav['ga_hit'] . '" ga-event-category="' . $sections_menu_nav['ga_event_category'] . '" ga-event-action="' . $sections_menu_nav['ga_event_action'] . '" ga-event-label="global nav - ' . $sections_menu_nav['ga_event_label'] . '"';
                                                    } ?>
                                                    <li><a href="<?php echo $section_url; ?>" <?php if (!empty($section_targuet)) {
                                                                                                    echo 'target="' . $section_targuet . '"';
                                                                                                } ?>class="nav-link js-scroll-trigger ga NA <?php echo $show_like_cta; ?> <?php if (!empty($id_section) && $id_section == $sections_menu_nav['id_section']) {
                                                                                                                                                                                echo $id_section . '|' . $sections_menu_nav['id_section'] . ' active';
                                                                                                                                                                            }; ?>" <?php if (!empty($ga_str)) {
                                                                                                                                                                                        echo $ga_str;
                                                                                                                                                                                    }; ?>><?php echo $sections_menu_nav['name']; ?></a></li>
                                                <?php
                                                }
                                            } else {
                                                // SHOW ALL SECTIONS IF THE USER IS LOGGED
                                                // GA
                                                $ga_str = '';
                                                if (!empty($sections_menu_nav['ga_command']) && !empty($sections_menu_nav['ga_hit']) && !empty($sections_menu_nav['ga_event_category']) && !empty($sections_menu_nav['ga_event_action']) && !empty($sections_menu_nav['ga_event_label'])) {
                                                    $ga_str = 'ga-command="' . $sections_menu_nav['ga_command'] . '" ga-hit="' . $sections_menu_nav['ga_hit'] . '" ga-event-category="' . $sections_menu_nav['ga_event_category'] . '" ga-event-action="' . $sections_menu_nav['ga_event_action'] . '" ga-event-label="global nav - ' . $sections_menu_nav['ga_event_label'] . '"';
                                                } ?>
                                                <li><a href="<?php echo $section_url; ?>" <?php if (!empty($section_targuet)) {
                                                                                                echo 'target="' . $section_targuet . '"';
                                                                                            } ?> class="nav-link ga NB <?php echo $show_like_cta; ?>" <?php if (!empty($ga_str)) {
                                                                                                                                                            echo $ga_str;
                                                                                                                                                        }; ?>><?php echo $sections_menu_nav['name']; ?></a></li>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                    <!-- <li><a href="#about-us">Nosotrso</a></li>
                                    <li>
                                        <a href="#services">Servicios</a>
                                        <ul class="submenu">
                                            <li><a href="#programming">Programación</a></li>
                                            <li><a href="#web-design">Diseño Web</a></li>
                                            <li><a href="#design">Diseño Gráfico</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#works">Trabajos</a></li>
                                    <li><a href="#contact">Contactos</a></li> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>