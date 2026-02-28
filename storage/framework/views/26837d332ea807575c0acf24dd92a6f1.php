<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Order Cloud Storage</h1>
    <p class="text-gray-600 text-lg">Secure, reliable storage solutions for your business</p>
</div>

<!-- Storage Plan Selection -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <!-- Standard Storage -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
        <div class="bg-blue-600 p-6 text-white text-center">
            <h3 class="text-2xl font-bold">Standard Storage</h3>
            <p class="text-blue-100 text-sm mt-1">Basic cloud storage</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">50,000</span>
                <span class="text-gray-600"> XAF/TB/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Unlimited access
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    99.9% uptime SLA
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Email support
                </li>
            </ul>
            
            <button onclick="selectStorage('standard', 'Standard Storage', 50000)" 
                    class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Premium Storage -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-2 border-mtn-yellow">
        <div class="bg-mtn-yellow p-6 text-black text-center">
            <div class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold mb-2">
                RECOMMENDED
            </div>
            <h3 class="text-2xl font-bold">Premium Storage</h3>
            <p class="text-gray-700 text-sm mt-1">Advanced features</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">75,000</span>
                <span class="text-gray-600"> XAF/TB/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Geo-redundancy
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    99.95% uptime SLA
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    24/7 priority support
                </li>
            </ul>
            
            <button onclick="selectStorage('premium', 'Premium Storage', 75000)" 
                    class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Enterprise Storage -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
        <div class="bg-purple-600 p-6 text-white text-center">
            <h3 class="text-2xl font-bold">Enterprise Storage</h3>
            <p class="text-purple-100 text-sm mt-1">Maximum security</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">100,000</span>
                <span class="text-gray-600"> XAF/TB/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Military-grade encryption
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    99.99% uptime SLA
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Dedicated account manager
                </li>
            </ul>
            
            <button onclick="selectStorage('enterprise', 'Enterprise Storage', 100000)" 
                    class="w-full bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                Select Plan
            </button>
        </div>
    </div>
</div>

<!-- Storage Configuration Form -->
<div id="storageForm" class="hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-mtn-black mb-6">Configure Your Storage</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Storage Configuration -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Storage Configuration</h3>
                
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <p class="text-gray-600 text-sm">Selected Plan</p>
                    <p id="selectedStorage" class="text-2xl font-bold text-mtn-black mt-2">Premium Storage</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Storage Size (TB) *</label>
                    <div class="flex gap-2 mb-2">
                        <button type="button" onclick="setStorage(1)" class="flex-1 py-2 px-3 border-2 border-gray-300 rounded-lg hover:border-mtn-yellow font-semibold">1 TB</button>
                        <button type="button" onclick="setStorage(5)" class="flex-1 py-2 px-3 border-2 border-gray-300 rounded-lg hover:border-mtn-yellow font-semibold">5 TB</button>
                        <button type="button" onclick="setStorage(10)" class="flex-1 py-2 px-3 border-2 border-gray-300 rounded-lg hover:border-mtn-yellow font-semibold">10 TB</button>
                    </div>
                    <input type="number" id="storageSize" name="storage_size" min="1" value="1" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                           onchange="calculateStorageCost()">
                    <p class="text-gray-600 text-sm mt-2">Price per TB: <span id="storagePricePerTB" class="font-bold">75,000 XAF</span></p>
                </div>
                
                <div class="bg-mtn-yellow p-6 rounded-lg">
                    <p class="text-black text-sm">Monthly Cost</p>
                    <p id="storageTotalCost" class="text-3xl font-bold text-black mt-2">75,000 XAF</p>
                    <p class="text-black text-sm mt-2">Annual: <span id="storageAnnualCost" class="font-bold">900,000 XAF</span></p>
                </div>
            </div>
            
            <!-- Order Information -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Order Information</h3>
                
                <form method="POST" action="<?php echo e(route('customer.storage-orders.store')); ?>" id="storageCheckoutForm">
                    <?php echo csrf_field(); ?>
                    
                    <input type="hidden" id="storage_type" name="storage_type">
                    <input type="hidden" id="storage_price_per_tb" name="storage_price_per_tb">
                    <input type="hidden" id="storage_size_input" name="storage_size">
                    <input type="hidden" id="storage_total_cost_input" name="total_cost">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Purpose of Storage *</label>
                        <select name="purpose" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                            <option value="">Select Purpose</option>
                            <option value="backups">Backups</option>
                            <option value="archival">Archival</option>
                            <option value="active_data">Active Data Storage</option>
                            <option value="disaster_recovery">Disaster Recovery</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Billing Cycle *</label>
                        <select name="billing_cycle" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly (Save 5%)</option>
                            <option value="annually">Annually (Save 15%)</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Data Location Preference</label>
                        <select name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                            <option value="cameroon">Cameroon (Primary)</option>
                            <option value="west_africa">West Africa Regional</option>
                            <option value="eu">Europe (Geo-redundant)</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Special Requirements</label>
                        <textarea name="special_requirements" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                                  placeholder="Any compliance requirements or special needs"></textarea>
                    </div>

                    <!-- Payment Method -->
<div class="mb-6">
    <h3 class="text-lg font-bold text-mtn-black mb-4">Payment Method</h3>
    
    <div class="space-y-3">
        <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
            <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4">
            <span class="ml-3">
                <span class="block font-semibold text-sm">MTN Mobile Money</span>
                <span class="text-xs text-gray-600">Pay with MTN +237</span>
            </span>
        </label>
        
        <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
            <input type="radio" name="payment_method" value="orange_money" required class="w-4 h-4">
            <span class="ml-3">
                <span class="block font-semibold text-sm">Orange Money</span>
                <span class="text-xs text-gray-600">Pay with Orange +237</span>
            </span>
        </label>
        
        <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
            <input type="radio" name="payment_method" value="card" required class="w-4 h-4">
            <span class="ml-3">
                <span class="block font-semibold text-sm">Credit/Debit Card</span>
                <span class="text-xs text-gray-600">Visa, Mastercard, Amex</span>
            </span>
        </label>

        <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow hover:bg-yellow-50">
            <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
            <span class="ml-3">
                <span class="block font-semibold text-sm">Credit Limit</span>
                <span class="text-xs text-gray-600">Available: <?php echo e(number_format(auth()->user()->getAvailableCredit(), 0)); ?> XAF</span>
            </span>
        </label>
    </div>
</div>
                    
                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                            Proceed to Checkout
                        </button>
                        <button type="button" onclick="resetStorage()" class="w-full bg-gray-300 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                            Choose Different Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
function selectStorage(type, name, pricePerTB) {
    document.getElementById('selectedStorage').textContent = name;
    document.getElementById('storagePricePerTB').textContent = number_format(pricePerTB) + ' XAF';
    document.getElementById('storage_type').value = type;
    document.getElementById('storage_price_per_tb').value = pricePerTB;
    document.getElementById('storageSize').value = 1;
    
    document.getElementById('storageForm').classList.remove('hidden');
    calculateStorageCost();
    document.getElementById('storageForm').scrollIntoView({ behavior: 'smooth' });
}

function setStorage(size) {
    document.getElementById('storageSize').value = size;
    calculateStorageCost();
}

function calculateStorageCost() {
    const size = parseInt(document.getElementById('storageSize').value) || 1;
    const pricePerTB = parseInt(document.getElementById('storage_price_per_tb').value) || 0;
    const monthlyTotal = size * pricePerTB;
    const annualTotal = monthlyTotal * 12;
    
    document.getElementById('storageTotalCost').textContent = number_format(monthlyTotal) + ' XAF';
    document.getElementById('storageAnnualCost').textContent = number_format(annualTotal) + ' XAF';
    document.getElementById('storage_size_input').value = size;
    document.getElementById('storage_total_cost_input').value = monthlyTotal;
}

function resetStorage() {
    document.getElementById('storageForm').classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function number_format(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/products/storage-ordering.blade.php ENDPATH**/ ?>