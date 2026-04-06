@php
    $variant = $variant ?? 'primary';
@endphp

<div class="cta-section">
    <div class="container">
        <h2>{{ $title ?? 'Ready to Grow Your Business?' }}</h2>
        <p>{{ $subtitle ?? 'Let\'s create something amazing together. Get your professional website or design today.' }}</p>
        <div class="cta-buttons">
            <a href="/contact" class="cta-button cta-button-primary">Get Started</a>
            <a href="/pricing" class="cta-button cta-button-outline">View Packages</a>
        </div>
    </div>
</div>