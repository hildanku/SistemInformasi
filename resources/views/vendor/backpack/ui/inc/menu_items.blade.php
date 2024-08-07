{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Areas" icon="la la-question" :link="backpack_url('area')" />
<x-backpack::menu-item title="Costs" icon="la la-question" :link="backpack_url('cost')" />
<x-backpack::menu-item title="Stalls" icon="la la-question" :link="backpack_url('stall')" />
<x-backpack::menu-item title="Rents" icon="la la-question" :link="backpack_url('rent')" />
<x-backpack::menu-item title="Payments" icon="la la-question" :link="backpack_url('payment')" />