<?php
/**
 * Plugin Name: Al-Amin Live Date & Time
 * Description: Elegant real-time ticking date and time in English and Bangla.
 * Version: 1.4
 * Author: Ratul
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Load Google Fonts for beautiful Bangla typography
function alamin_clock_fonts() {
    wp_enqueue_style('alamin-google-fonts', 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500&family=Inter:wght@400;500&display=swap');
}
add_action('wp_enqueue_scripts', 'alamin_clock_fonts');

function alamin_live_datetime_shortcode() {
    date_default_timezone_set('Asia/Dhaka');
    
    // Initial display for SEO
    $en_date = date('l, F j, Y | h:i:s A');
    
    // CSS Styling (Light theme, no black)
    $style = "
    <style>
        .alamin-clock-container {
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            color: #555; /* Soft grey instead of black */
            background: #f9f9f9;
            padding: 10px 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37; /* Gold accent for Al-Amin Jewellers */
            display: inline-block;
            line-height: 1.6;
            font-size: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .bn-text { font-family: 'Hind Siliguri', sans-serif; color: #777; }
        .divider { color: #d4af37; margin: 0 10px; font-weight: bold; }
    </style>";

    $output = $style;
    $output .= '<div class="alamin-clock-container">';
    $output .= '<span id="alamin-ticking-clock">Date : ' . $en_date . '</span>';
    $output .= '</div>';

    // Real-time ticking Script
    $output .= "
    <script>
    (function() {
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };

            const enDate = now.toLocaleDateString('en-US', options);
            const enTime = now.toLocaleTimeString('en-US', timeOptions);
            const bnDate = now.toLocaleDateString('bn-BD', options);
            const bnTime = now.toLocaleTimeString('bn-BD', timeOptions);

            const clockEl = document.getElementById('alamin-ticking-clock');
            if(clockEl) {
                clockEl.innerHTML = `
                    <span class='en-text'>Date : \${enDate} | \${enTime}</span>
                    <span class='divider'>|</span>
                    <span class='bn-text'>\${bnDate} | \${bnTime}</span>
                `;
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    })();
    </script>";

    return $output;
}
add_shortcode('live_datetime', 'alamin_live_datetime_shortcode');