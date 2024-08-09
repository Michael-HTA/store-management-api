<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\ModelForm;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public $form_data = [
        "Analgesics" => "Pain relievers",
        "Antibiotics" => "Medicines that fight bacterial infections",
        "Antivirals" => "Medicines that treat viral infections",
        "Antifungals" => "Medicines that treat fungal infections",
        "Antihistamines" => "Medicines that relieve allergy symptoms",
        "Anti-inflammatory Drugs" => "Medicines that reduce inflammation",
        "Antipyretics" => "Medicines that reduce fever",
        "Cardiovascular Drugs" => "Medicines for heart and blood vessel conditions",
        "Gastrointestinal Drugs" => "Medicines for digestive system issues",
        "Hormonal Drugs" => "Medicines that affect hormone levels",
        "Immunosuppressants" => "Medicines that suppress the immune system",
        "Psychotropic Drugs" => "Medicines that affect mental state",
        "Diuretics" => "Medicines that promote urine production",
        "Anticoagulants" => "Medicines that prevent blood clotting",
        "Vitamins and Supplements" => "Nutritional supplements",
        "Antiseptics" => "Medicines that prevent infection on the skin",
        "Anthelmintics" => "Medicines that treat parasitic worm infections",
        "Bronchodilators" => "Medicines that open airways in the lungs",
        "Antineoplastics" => "Medicines that treat cancer",
        "Ophthalmic Drugs" => "Medicines for eye conditions",
        "Dermatological Drugs" => "Medicines for skin conditions",
        "Respiratory Drugs" => "Medicines for respiratory conditions",
        "Sedatives and Hypnotics" => "Medicines that induce sedation or sleep",
        "Antidiabetic Drugs" => "Medicines that manage diabetes",
        "Vaccines" => "Biological preparations providing immunity",
        "Antidepressants" => "Medicines that treat depression",
        "Anticonvulsants" => "Medicines that prevent seizures",
        "Antiobesity Drugs" => "Medicines that help with weight loss",
        "Antiulcer Drugs" => "Medicines that treat ulcers",
        "Antiemetics" => "Medicines that prevent or treat nausea and vomiting",
        "Antipsychotics" => "Medicines that treat psychiatric conditions",
        "Antimalarials" => "Medicines that treat or prevent malaria",
        "Antiparasitics" => "Medicines that treat parasitic infections",
        "Antispasmodics" => "Medicines that relieve muscle spasms",
        "Antitussives" => "Medicines that suppress coughing",
        "Expectorants" => "Medicines that help clear mucus from the respiratory tract",
        "Laxatives" => "Medicines that relieve constipation",
        "Antacids" => "Medicines that neutralize stomach acid",
        "Probiotics" => "Beneficial bacteria supplements",
        "Muscle Relaxants" => "Medicines that relieve muscle tension",
        "Antianxiety Drugs" => "Medicines that treat anxiety",
        "Stimulants" => "Medicines that increase alertness and energy",
        "Antigout Drugs" => "Medicines that treat gout",
        "Hemostatics" => "Medicines that help stop bleeding",
        "Antimigraine Drugs" => "Medicines that treat migraines",
        "Antiretrovirals" => "Medicines that treat HIV/AIDS",
        "Antidotes" => "Medicines that counteract poisons",
        "Chelating Agents" => "Medicines that remove heavy metals from the body",
        "Immunomodulators" => "Medicines that modify the immune response",
        "Hormone Replacement Therapy" => "Medicines that replace deficient hormones",
        "Antiplatelet Drugs" => "Medicines that prevent blood clots by inhibiting platelets",
        "Antiseizure Drugs" => "Medicines that prevent or treat seizures",
        "Nasal Decongestants" => "Medicines that relieve nasal congestion",
        "Corticosteroids" => "Medicines that reduce inflammation and immune response",
        "Biologics" => "Medicines derived from living organisms for various conditions",
        "Topical Agents" => "Medicines applied to the skin or mucous membranes",
        "Enzymes" => "Medicines that supplement or replace missing enzymes",
        "Growth Factors" => "Medicines that promote cell growth and healing",
        "Immunizations" => "Vaccines and other products that induce immunity",
        "Anticholinergics" => "Medicines that block the action of acetylcholine",
        "Antidiarrheals" => "Medicines that relieve diarrhea",
        "Antiflatulents" => "Medicines that relieve gas",
        "Antiseptics and Disinfectants" => "Chemicals that prevent infection on living tissue and surfaces",
        "Erectile Dysfunction Drugs" => "Medicines that treat erectile dysfunction",
        "Smoking Cessation Aids" => "Medicines that help people quit smoking",
        "Nutritional Supplements" => "Products that provide essential nutrients",
        "Osteoporosis Drugs" => "Medicines that treat or prevent bone loss",
        "Thyroid Drugs" => "Medicines that treat thyroid disorders",
        "Urological Drugs" => "Medicines that treat urinary tract issues",
        "Antiprotozoals" => "Medicines that treat protozoan infections",
        "Cough Suppressants" => "Medicines that suppress coughing",
    ];

    public $model_forms = [
        'Tablet',
        'Liquid',
        'Capsule',
        'Powder',
        'Granule',
        'Syrup',
        'Suspension',
        'Cream',
        'Gel',
        'Lotion',
        'Suppositorie',
        'Inhaler',
        'Injectable',
        'Implant',
    ];


    public $suppliers = [
        "Myanmar Pharmaceutical Industry (MPI)" => "09-00000000",
        "Global Star Medical Co., Ltd." => "09-00000000",
        "Sanofi Myanmar" => "09-00000000",
        "Pfizer Myanmar" => "09-00000000",
        "Johnson & Johnson Myanmar" => "09-00000000",
        "MSD Myanmar" => "09-00000000",
        "AstraZeneca Myanmar" => "09-00000000",
        "Boehringer Ingelheim Myanmar" => "09-00000000",
        "Novartis Myanmar" => "09-00000000",
        "Roche Myanmar" => "09-00000000",
    ];

    public $manufacturers = [
        "Pfizer Inc.",
        "Johnson & Johnson",
        "Roche Holding AG",
        "Novartis International AG",
        "Merck & Co., Inc.",
        "Sanofi S.A.",
        "GlaxoSmithKline plc (GSK)",
        "AstraZeneca PLC",
        "Bayer AG",
        "Boehringer Ingelheim GmbH",
    ];


    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        foreach($this->form_data as $key => $value){
            Category::create([
                'name' => $key,
                'description' => $value,
            ]);
        }

        foreach($this->model_forms as $model){
            ModelForm::create([
                'name' => $model,
            ]);
        }

        foreach($this->suppliers as $key => $value){
                Supplier::create([
                    'name' => $key,
                    'phone' => $value,
                ]);
            }

        foreach($this->manufacturers as $manufacturer){
            Manufacturer::create([
                'name' => $manufacturer,
            ]);
        }

        Product::create([
            'name' => 'para',
            'manufacturing_date' => now(),
            'expiry_date' => now(),
            'product_code' => 'P0001',
            'quantity' => 10,
            'price' => 100,
            'model_form_id' => 1,
            'category_id' => 1,
            'manufacturer_id' => 1,
            'supplier_id' => 1,
        ]);

        Product::create([
            'name' => 'Decogen',
            'manufacturing_date' => now(),
            'expiry_date' => now(),
            'product_code' => 'P0002',
            'quantity' => 5,
            'price' => 100,
            'model_form_id' => 2,
            'category_id' => 2,
            'manufacturer_id' => 2,
            'supplier_id' => 2,
        ]);


    }
}
