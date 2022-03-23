<?php

use App\Models\GroupMenuModel;
use App\Models\MenuModel;

if (!function_exists('menu')) {
    /**
     * Helpers for build menu.
     *
     * @return array
     */
    function menu()
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function parse($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = parse($item, $value->id);
                    $value->children = $child ?: $child;
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->where('active', 1)->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return parse((new GroupMenuModel())->menuHasRole(), 0);
    }
}

if (!function_exists('nestable')) {
    /**
     * Helpers for build menu.
     *
     * @return array
     */
    function nestable()
    {
        /**
         * Function parse.
         *
         * @param item       array
         * @param parent_id  int
         *
         * @return array
         */
        function nest($item, $parent_id)
        {
            $data = [];
            foreach ($item as $value) {
                if ($value->parent_id == $parent_id) {
                    $child = nest($item, $value->id);
                    $value->children = $child ? $child : '';
                    $data[] = $value;
                }
            }
            // cache()->delete('menu');
            return $data;
        }

        // TODO: cache the result
        // if (! $found = cache('menu')) {
        //     $data = parse((new MenuModel())->orderBy('sequence', 'asc')->findAll(), 0);
        //     cache()->save('menu', $data, 300);
        // }
        // return $found;
        return nest((new MenuModel())->orderBy('sequence', 'asc')->get()->getResultObject(), 0);
    }
}

/**
 * The ugly for generate some html.
 *
 * return string hrml
 */
if (!function_exists('build')) {
    function build()
    {
        $html = '';
        foreach (menu() as $parent) {
            $open = current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'menu-open' : '';
            $active = current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'active' : '';
            $link = base_url($parent->route);

            $html .= "<li class='nav-item has-treeview {$open}'>";
            $html .= "<a href='{$link}' class='nav-link {$active}'>";
            $html .= "<i class='nav-icon {$parent->icon}'></i>";
            $html .= '<p>';
            $html .= $parent->title;
            if (count($parent->children)) {
                $html .= "<i class='right fas fa-angle-left'></i>";
            }
            $html .= '</p>';
            $html .= '</a>';
            if (count($parent->children)) {
                $html .= "<ul class='nav nav-treeview'>";
                foreach ($parent->children as $child) {
                    $link_child = base_url($child->route);
                    $active_child = current_url() == base_url($child->route) ? 'active' : '';
                    $html .= "<li class='nav-item has-treeview'>";
                    $html .= "<a href='{$link_child}'";
                    $html .= "class='nav-link {$active_child}'>";
                    $html .= "<i class='nav-icon {$child->icon}'></i>";
                    $html .= "<p>{$child->title}</p>";
                    $html .= '</a>';
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }
    if (!function_exists('bulan')) {
        function bulan($mont)
        {
            $bulan = $mont;
            switch ($bulan) {
                case 1:
                    $bulan = "I";
                    break;
                case 2:
                    $bulan = "II";
                    break;
                case 3:
                    $bulan = "III";
                    break;
                case 4:
                    $bulan = "IV";
                    break;
                case 5:
                    $bulan = "V";
                    break;
                case 6:
                    $bulan = "VI";
                    break;
                case 7:
                    $bulan = "VII";
                    break;
                case 8:
                    $bulan = "VIII";
                    break;
                case 9:
                    $bulan = "IX";
                    break;
                case 10:
                    $bulan = "X";
                    break;
                case 11:
                    $bulan = "XI";
                    break;
                case 12:
                    $bulan = "XII";
                    break;
                    // default:
                    //     $bulan = Date('F');
                    //     break;
            }
            return $bulan;
        }
    }
    if (!function_exists('moon')) {
        function moon($bulan)
        {
            $moon = $bulan;
            switch ($moon) {
                case 1:
                    $moon = "Januari";
                    break;
                case 2:
                    $moon = "Februari";
                    break;
                case 3:
                    $moon = "Maret";
                    break;
                case 4:
                    $moon = "April";
                    break;
                case 5:
                    $moon = "Mei";
                    break;
                case 6:
                    $moon = "Juni";
                    break;
                case 7:
                    $moon = "Juli";
                    break;
                case 8:
                    $moon = "Agustus";
                    break;
                case 9:
                    $moon = "September";
                    break;
                case 10:
                    $moon = "Oktober";
                    break;
                case 11:
                    $moon = "November";
                    break;
                case 12:
                    $moon = "Desember";
                    break;
                    // default:
                    //     $moon = Date('F');
                    //     break;
            }
            return $moon;
        }
    }
}
