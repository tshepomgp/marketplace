<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Order Microsoft 365 Licenses</h1>
    <p class="text-gray-600 text-lg">Choose your plan and number of licenses below</p>
</div>

<!-- Product Selection -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <!-- Product Card 1 -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">
        <div class="bg-mtn-yellow p-6 text-center">
            <h3 class="text-2xl font-bold text-black">Microsoft 365</h3>
            <p class="text-black text-sm mt-1">Business Basic</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-4xl font-bold text-mtn-black">12,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Web & mobile apps
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    1TB cloud storage
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Teams meetings
                </li>
            </ul>
            
            <button onclick="selectProduct(1, 'BUSINESS_BASIC', 'Business Basic', 12000)" 
                    class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Product Card 2 -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2 border-2 border-mtn-yellow">
        <div class="bg-mtn-yellow p-6 text-center">
            <div class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold mb-2">
                MOST POPULAR
            </div>
            <h3 class="text-2xl font-bold text-black">Microsoft 365</h3>
            <p class="text-black text-sm mt-1">Business Standard</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-4xl font-bold text-mtn-black">25,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Full desktop apps
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    1TB cloud storage
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Advanced Teams
                </li>
            </ul>
            
            <button onclick="selectProduct(2, 'BUSINESS_STANDARD', 'Business Standard', 25000)" 
                    class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Product Card 3 -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">
        <div class="bg-mtn-yellow p-6 text-center">
            <h3 class="text-2xl font-bold text-black">Microsoft 365</h3>
            <p class="text-black text-sm mt-1">Business Premium</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-4xl font-bold text-mtn-black">35,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    All Standard features
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Advanced security
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Desktop & web
                </li>
            </ul>
            
            <button onclick="selectProduct(3, 'BUSINESS_PREMIUM', 'Business Premium', 35000)" 
                    class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Select Plan
            </button>
        </div>
    </div>
</div>

<!-- Order Form (Hidden initially) -->
<div id="orderForm" class="hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-mtn-black mb-6">Review Your Order</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Order Details -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Order Details</h3>
                
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <p class="text-gray-600 text-sm">Selected Plan</p>
                    <p id="selectedPlan" class="text-2xl font-bold text-mtn-black mt-2">Microsoft 365 Business Standard</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Licenses *</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                           onchange="calculateTotal()">
                    <p class="text-gray-600 text-sm mt-2">Price per license: <span id="unitPrice" class="font-bold">25,000 XAF</span></p>
                </div>
                
                <div class="bg-mtn-yellow p-6 rounded-lg">
                    <p class="text-black text-sm">Total Cost (Monthly)</p>
                    <p id="totalCost" class="text-3xl font-bold text-black mt-2">625,000 XAF</p>
                </div>
            </div>
            
            <!-- Add to Cart Form -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Add to Cart</h3>
                
                <form method="POST" action="<?php echo e(route('cart.add')); ?>" id="addToCartForm">
                    <?php echo csrf_field(); ?>
                    
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" name="quantity" id="quantityInput" value="1">
                    
                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-gray-600">You're adding:</p>
                        <p id="cartPlanName" class="text-xl font-bold text-mtn-black mt-2">Microsoft 365 Business Standard</p>
                        <p class="text-sm text-gray-600 mt-2">Quantity: <span id="cartQuantity" class="font-bold">1</span> licenses</p>
                        <p class="text-sm text-gray-600 mt-1">Total: <span id="cartTotal" class="font-bold text-mtn-yellow">25,000 XAF</span>/month</p>
                    </div>
                    
                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                            Add to Cart
                        </button>
                        <button type="button" onclick="resetOrder()" class="w-full bg-gray-300 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                            Choose Different Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
<?php if(session('success')): ?>
<div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<!-- JavaScript -->
<script>
function selectProduct(productId, sku, name, price) {
    document.getElementById("selectedPlan").textContent = "Microsoft 365 " + name;
    document.getElementById("cartPlanName").textContent = "Microsoft 365 " + name;
    document.getElementById("unitPrice").textContent = number_format(price) + " XAF";
    document.getElementById("product_id").value = productId;
    document.getElementById("quantity").value = 1;
    
    document.getElementById("orderForm").classList.remove("hidden");
    calculateTotal();
    document.getElementById("orderForm").scrollIntoView({ behavior: "smooth" });
}

function calculateTotal() {
    const quantity = parseInt(document.getElementById("quantity").value) || 1;
    const unitPrice = document.getElementById("unitPrice").textContent;
    const unitPriceNum = parseInt(unitPrice.replace(/\D/g, '')) || 0;
    const total = quantity * unitPriceNum;
    
    document.getElementById("totalCost").textContent = number_format(total) + " XAF";
    document.getElementById("quantityInput").value = quantity;
    document.getElementById("cartQuantity").textContent = quantity;
    document.getElementById("cartTotal").textContent = number_format(total) + " XAF";
}

function resetOrder() {
    document.getElementById("orderForm").classList.add("hidden");
    window.scrollTo({ top: 0, behavior: "smooth" });
}

function number_format(num) {
    return new Intl.NumberFormat("fr-FR").format(num);
}

document.getElementById("quantity").addEventListener("change", calculateTotal);
document.getElementById("quantity").addEventListener("input", calculateTotal);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\TMOKK5\Projects\microsoft-marketplace\resources\views/customer/products/licence-ordering.blade.php ENDPATH**/ ?>