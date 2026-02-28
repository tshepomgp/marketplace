<?php $__env->startSection('title', 'Find Your Domain'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Find Your Perfect Domain</h1>
    <p class="text-gray-600 text-lg">Search and register your domain name</p>
</div>

<!-- Selected Plan Info -->
<?php if($selectedPlan): ?>
<div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-8">
    <p class="text-blue-900"><strong>Selected Plan:</strong> <?php echo e($selectedPlan->name); ?> - <?php echo e(number_format($selectedPlan->price_per_mailbox, 0)); ?> XAF/month + <?php echo e(number_format($selectedPlan->domain_price, 0)); ?> XAF domain</p>
</div>
<?php endif; ?>

<!-- Domain Search -->
<div class="bg-white rounded-lg shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-bold text-mtn-black mb-6">Search Domain</h2>
    <form method="POST" action="<?php echo e(route('customer.email-hosting.check-availability')); ?>" id="domainSearchForm">
    <?php echo csrf_field(); ?>
    <!-- ADD THIS LINE - Pass plan_id through form -->
    <input type="hidden" name="plan_id" value="<?php echo e(request()->query('plan_id')); ?>">
    
    <div class="max-w-2xl">
     <div class="flex flex-col md:flex-row gap-4 mb-6">
    <div class="flex-1">
        <label for="domainInput" class="block text-sm font-semibold text-gray-700 mb-2">Domain Name</label>
        <input type="text" id="domainInput" name="domain" placeholder="e.g., mycompany, yoursite (without .cm)" 
               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-mtn-yellow text-lg">
        <p class="text-xs text-gray-600 mt-2">.cm is the most popular. We also support .com, .net, .org</p>
    </div>
    <div class="flex-1">
        <label for="tldSelect" class="block text-sm font-semibold text-gray-700 mb-2">TLD (Top Level Domain)</label>
        <select id="tldSelect" name="tld" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-mtn-yellow">
                    <option value=".cm">.cm (Cameroon)</option>
                    <option value=".com">.com (International)</option>
                    <option value=".net">.net (Networks)</option>
                    <option value=".org">.org (Organization)</option>
                    <option value=".biz">.biz (Business)</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                    Check Availability
                </button>
            </div>
        </div>
</form>
        
<!-- Search Results -->
<div id="resultsContainer" class="hidden mb-8">  <!-- ← MUST BE HERE -->
    <div id="searchingMessage" class="text-center py-8">  <!-- ← MUST BE HERE -->
        <div class="inline-block">
            <svg class="animate-spin h-8 w-8 text-mtn-yellow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <p class="text-gray-600 mt-4">Searching...</p>
    </div>

    <div id="availableMessage" class="hidden">  <!-- ← MUST BE HERE -->
        <div class="bg-green-50 border-2 border-green-500 rounded-lg p-6 text-center mb-6">
            <svg class="w-16 h-16 text-green-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-2xl font-bold text-green-900 mb-2" id="availableDomainName"></p>
            <p class="text-green-700 mb-4">This domain is available!</p>
            <p class="text-3xl font-bold text-green-600 mb-6" id="domainPrice"></p>
            
            <form id="checkoutForm" method="GET" action="<?php echo e(route('customer.email-hosting.checkout')); ?>">
                <input type="hidden" name="domain" id="selectedDomain">
                <input type="hidden" name="plan_id" value="<?php echo e($selectedPlan->id ?? ''); ?>">
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition">
                    Continue to Checkout
                </button>
            </form>
        </div>
    </div>

    <div id="unavailableMessage" class="hidden">  <!-- ← MUST BE HERE -->
        <div class="bg-red-50 border-2 border-red-500 rounded-lg p-6 text-center mb-6">
            <svg class="w-16 h-16 text-red-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-2xl font-bold text-red-900 mb-4" id="unavailableDomainName"></p>
            <p class="text-red-700 mb-6">Sorry, this domain is not available.</p>
            
            <div class="bg-white p-4 rounded-lg mb-6">
                <p class="text-sm text-gray-600 mb-3">Try these alternatives:</p>
                <div id="suggestedDomains" class="space-y-2 text-left"></div>
            </div>
            
            <button onclick="document.getElementById('domainInput').focus(); document.getElementById('resultsContainer').classList.add('hidden');" 
                    class="w-full bg-mtn-yellow text-black py-3 rounded-lg font-bold hover:bg-mtn-orange transition">
                Try Another Domain
            </button>
        </div>
    </div>
</div>

        <!-- Featured Domains -->
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="font-bold text-mtn-black mb-4">Popular Domains</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-white p-3 rounded border border-gray-300">
                    <p class="font-semibold">company.cm</p>
                    <p class="text-gray-600">35,000 XAF/year</p>
                </div>
                <div class="bg-white p-3 rounded border border-gray-300">
                    <p class="font-semibold">business.cm</p>
                    <p class="text-gray-600">35,000 XAF/year</p>
                </div>
                <div class="bg-white p-3 rounded border border-gray-300">
                    <p class="font-semibold">myshop.cm</p>
                    <p class="text-gray-600">35,000 XAF/year</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function checkDomain() {
    const domainInput = document.getElementById('domainInput').value.trim();
    const tld = document.getElementById('tldSelect').value;
    
    if (!domainInput) {
        alert('Please enter a domain name');
        return;
    }
    
    const domain = domainInput + tld;
    console.log('Checking domain:', domain);
    
    const resultsContainer = document.getElementById('resultsContainer');
    const searchingMessage = document.getElementById('searchingMessage');
    const availableMessage = document.getElementById('availableMessage');
    const unavailableMessage = document.getElementById('unavailableMessage');
    
    resultsContainer.classList.remove('hidden');
    searchingMessage.classList.remove('hidden');
    availableMessage.classList.add('hidden');
    unavailableMessage.classList.add('hidden');
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found in meta tags!');
        alert('Security error: CSRF token missing. Refresh the page.');
        return;
    }
    
    // Make API call
    fetch('<?php echo e(route("customer.email-hosting.check-availability")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: JSON.stringify({ domain: domain })
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error('HTTP error, status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('API Response:', data);
        searchingMessage.classList.add('hidden');
        
        if (data.available) {
            document.getElementById('availableDomainName').textContent = data.domain;
            document.getElementById('domainPrice').textContent = number_format(data.price) + ' XAF/year';
            document.getElementById('selectedDomain').value = data.domain;
            availableMessage.classList.remove('hidden');
        } else {
            document.getElementById('unavailableDomainName').textContent = data.domain;
            unavailableMessage.classList.remove('hidden');
            generateSuggestions(domainInput, tld);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        searchingMessage.classList.add('hidden');
        alert('Error: ' + error.message);
    });
}

function number_format(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}

function generateSuggestions(domain, tld) {
    const variations = [
        domain + 'pro' + tld,
        domain + 'io' + tld,
        'the' + domain + tld,
        'get' + domain + tld,
        domain + '2024' + tld,
    ];
    
    const suggestionsHtml = variations.map(variation => `
        <button onclick="setDomain('${variation}')" class="text-left hover:text-mtn-yellow font-semibold">
            → ${variation}
        </button>
    `).join('');
    
    document.getElementById('suggestedDomains').innerHTML = suggestionsHtml;
}

function setDomain(domain) {
    document.getElementById('domainInput').value = domain.replace(/\.[^.]+$/, '');
    checkDomain();
}

function number_format(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}

// Allow Enter key to check domain
document.getElementById('domainInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        checkDomain();
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/email-hosting/domain-search.blade.php ENDPATH**/ ?>