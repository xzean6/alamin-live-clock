<?php
/**
 * Plugin Name: Al-Amin Live Date & Time
 * Description: Real-time ticking date and time in English and Bangla.
 * Version: 1.3
 * Author: Ratul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function alamin_live_datetime_shortcode() {
    date_default_timezone_set('Asia/Dhaka');
    
    // Initial display for SEO (Server-side)
    $en_date = date('l, F j, Y | h:i:s A');
    
    // The container where JS will take over
    $output = '<span id="alamin-ticking-clock" style="font-weight: 500; color: #444;">';
    $output .= 'Date : ' . $en_date;
    $output .= '</span>';

    // Inline Script to handle the ticking
    $output .= "
    <script>
    (function() {
        function updateClock() {
            const now = new Date();
            
            // English
            const en = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            const enT = now.toLocaleTimeString('en-US', { hour12: true });

            // Bangla
            const bn = now.toLocaleDateString('bn-BD', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            const bnT = now.toLocaleTimeString('bn-BD', { hour12: true });

            const fullString = `Date : \${en} | \${enT} | \${bn} | \${bnT}`;
            const clockEl = document.getElementById('alamin-ticking-clock');
            if(clockEl) clockEl.innerHTML = fullString;
        }
        setInterval(updateClock, 1000);
    })();
    </script>";

    return $output;
}
add_shortcode('live_datetime', 'alamin_live_datetime_shortcode');