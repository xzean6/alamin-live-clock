function updateAlAminClock() {
    const now = new Date();
    
    // English Formatting
    const enOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const enDate = now.toLocaleDateString('en-US', enOptions);
    const enTime = now.toLocaleTimeString('en-US', { hour12: true });

    // Bangla Formatting
    const bnOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const bnDate = now.toLocaleDateString('bn-BD', bnOptions);
    const bnTime = now.toLocaleTimeString('bn-BD', { hour12: true });

    // Construct the string
    const displayString = `Date : ${enDate} | ${enTime} | ${bnDate} | ${bnTime}`;
    
    // Find all instances of our clock and update them
    document.querySelectorAll('.alamin-live-clock').forEach(el => {
        el.innerHTML = displayString;
    });
}

// Run the clock immediately and then every second
document.addEventListener('DOMContentLoaded', () => {
    updateAlAminClock();
    setInterval(updateAlAminClock, 1000);
});