@extends('layouts.customer')

@section('title', 'Colocation - Rack Space')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold text-mtn-black mb-2">Colocation - Rack Space</h1>
    <p class="text-gray-600">Secure, reliable data center colocation solutions</p>
</div>

<!-- Rack Space Plans -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <!-- Standard Rack -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-2 border-gray-200">
        <div class="bg-blue-600 p-6 text-white text-center">
            <h3 class="text-2xl font-bold">Standard Rack</h3>
            <p class="text-blue-100 text-sm mt-1">Half Rack Space</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">500,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    21U Rack Space
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Redundant Power Supply
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    24/7 Physical Security
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    10 Mbps Bandwidth Included
                </li>
            </ul>
            
            <button onclick="selectColocation('standard', 'Standard Rack', 500000, '21U')" 
                    class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Premium Rack -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-2 border-mtn-yellow">
        <div class="bg-mtn-yellow p-6 text-black text-center">
            <div class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold mb-2">
                RECOMMENDED
            </div>
            <h3 class="text-2xl font-bold">Premium Rack</h3>
            <p class="text-gray-700 text-sm mt-1">Full Rack Space</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">900,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    42U Rack Space
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Dual Power Distribution
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    100 Mbps Bandwidth
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-mtn-yellow mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    24/7 Support & Monitoring
                </li>
            </ul>
            
            <button onclick="selectColocation('premium', 'Premium Rack', 900000, '42U')" 
                    class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                Select Plan
            </button>
        </div>
    </div>
    
    <!-- Enterprise Rack -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition border-2 border-gray-200">
        <div class="bg-purple-600 p-6 text-white text-center">
            <h3 class="text-2xl font-bold">Enterprise Rack</h3>
            <p class="text-purple-100 text-sm mt-1">Multiple Racks</p>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-mtn-black">1,500,000</span>
                <span class="text-gray-600"> XAF/month</span>
            </div>
            
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    84U Custom Cabinet
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    1 Gbps Dedicated Connection
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Priority Support SLA
                </li>
                <li class="flex items-center text-gray-700">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Dedicated Account Manager
                </li>
            </ul>
            
            <button onclick="selectColocation('enterprise', 'Enterprise Rack', 1500000, '84U')" 
                    class="w-full bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                Select Plan
            </button>
        </div>
    </div>
</div>

<!-- Order Form -->
<div id="colocationForm" class="hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-mtn-black mb-6">Configure Your Colocation</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Configuration -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Rack Configuration</h3>
                
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <p class="text-gray-600 text-sm">Selected Plan</p>
                    <p id="selectedColocation" class="text-2xl font-bold text-mtn-black mt-2">Premium Rack</p>
                </div>
                
                
                <div class="bg-mtn-yellow p-6 rounded-lg">
                    <p class="text-black text-sm">Monthly Cost</p>
                    <p id="colocationTotalCost" class="text-3xl font-bold text-black mt-2">900,000 XAF</p>
                </div>
            </div>
            
            <!-- Order Information -->
            <div>
                <h3 class="text-lg font-bold text-mtn-black mb-4">Order Information</h3>
                
                <form method="POST" action="{{ route('customer.colocation.store') }}" id="colocationCheckoutForm" class="space-y-4">
                    @csrf
                    
                    <input type="hidden" id="colocation_type" name="colocation_type">
                    <input type="hidden" id="colocation_cost" name="monthly_cost">
                    
		          <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Data Center Location *</label>
                    <select name="location" id="location" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                        <option value="">Select Location</option>
                        <option value="cameroon">Cameroon Data Center</option>
                        <option value="west_africa">West Africa Regional</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Power Requirements *</label>
                    <select name="power_requirement" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                        <option value="">Select Power</option>
                        <option value="single">Single Phase (10A)</option>
                        <option value="dual">Dual Phase (20A)</option>
                        <option value="three">Three Phase (30A)</option>
                    </select>
                </div>
	

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Organization Name *</label>
                        <input type="text" name="organization_name" value="{{ Auth::user()->customer->company_name }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Name *</label>
                        <input type="text" name="contact_name" value="{{ Auth::user()->name }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Special Requirements</label>
                        <textarea name="special_requirements" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-mtn-yellow"
                                  placeholder="Any compliance or special needs"></textarea>
                    </div>
                    
                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method *</label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow">
                                <input type="radio" name="payment_method" value="mtn_momo" required class="w-4 h-4">
                                <span class="ml-3 text-sm">MTN Mobile Money</span>
                            </label>
                            <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow">
                                <input type="radio" name="payment_method" value="card" required class="w-4 h-4">
                                <span class="ml-3 text-sm">Credit Card</span>
                            </label>
                            <label class="flex items-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-mtn-yellow">
                                <input type="radio" name="payment_method" value="credit" required class="w-4 h-4">
                                <span class="ml-3 text-sm">Credit Limit (Available: {{ number_format(Auth::user()->getAvailableCredit(), 0) }} XAF)</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <button type="submit" class="w-full bg-mtn-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-mtn-orange transition">
                            Order Rack Space
                        </button>
                        <button type="button" onclick="resetColocation()" class="w-full bg-gray-300 text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                            Choose Different Plan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function selectColocation(type, name, cost, size) {
    document.getElementById('selectedColocation').textContent = name;
    document.getElementById('colocation_type').value = type;
    document.getElementById('colocation_cost').value = cost;
    document.getElementById('colocationTotalCost').textContent = number_format(cost) + ' XAF';
    document.getElementById('colocationForm').classList.remove('hidden');
    document.getElementById('colocationForm').scrollIntoView({ behavior: 'smooth' });
}

function resetColocation() {
    document.getElementById('colocationForm').classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function number_format(num) {
    return new Intl.NumberFormat('fr-FR').format(num);
}
</script>

@endsection
