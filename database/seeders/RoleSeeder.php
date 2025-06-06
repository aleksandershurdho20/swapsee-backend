<?php

namespace Database\Seeders;

use App\RolesEnum;
use App\PermissionsEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $vendorRole = Role::create(['name' => RolesEnum::Vendor->value]);
        $adminRole = Role::create(['name' => RolesEnum::Administrator->value]);

        $approveVendors = Permission::create(['name' => PermissionsEnum::ApproveVendors->value]);
        $sellProducts = Permission::create(['name' => PermissionsEnum::SellProducts->value]);
        $buyProducts = Permission::create(['name' => PermissionsEnum::BuyProducts->value]);

        $userRole->syncPermissions([$buyProducts]);

        $vendorRole->syncPermissions([
            $buyProducts,
            $sellProducts,
        ]);

        $adminRole->syncPermissions([
            $approveVendors,
            $buyProducts,
            $sellProducts,
        ]);
    }
}
