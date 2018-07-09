<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class TenantDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->addRolesAndPermissions();
        $this->addCategories();
        $this->addSkills();
    }
    private function addRolesAndPermissions()
    {
        // create permissions for a super admin
        $superAdminPermissions = Permission::create(['name' => 'manage everything']);
        // create permissions for an admin
        $adminPermissions = Permission::create(['name' => 'manage users']);
        // create permissions for an executive sponsor
        $executiveSponsorPermissions = Permission::create(['name' => 'sponsor project']);
        // create permissions for an gig sponsor
        $gigSponsorPermissions = collect(['create project', 'edit project', 'delete project'])->map(function ($name) {
            return Permission::create(['name' => $name]);
        });
        // create permissions for an gig participant
        $gigParticipantPermissions = Permission::create(['name' => 'join project']);

        // add super admin role
        $superAdminRole = Role::create(['name' => 'super admin']);
        // add permissions for super admin role
        $superAdminRole->givePermissionTo($superAdminPermissions);
        $superAdminRole->givePermissionTo($adminPermissions);
        $superAdminRole->givePermissionTo($executiveSponsorPermissions);
        $superAdminRole->givePermissionTo($gigSponsorPermissions);
        $superAdminRole->givePermissionTo($gigParticipantPermissions);

        // add admin role
        $adminRole = Role::create(['name' => 'admin']);
        // add permissions for admin role
        $adminRole->givePermissionTo($gigSponsorPermissions);
        $adminRole->givePermissionTo($adminPermissions);

        // add admin executive sponsor role
        $executiveSponsorRole = Role::create(['name' => 'executive sponsor']);
        // add permissions for admin role
        $executiveSponsorRole->givePermissionTo($executiveSponsorPermissions);
        $executiveSponsorRole->givePermissionTo($gigSponsorPermissions);
        $executiveSponsorRole->givePermissionTo($gigParticipantPermissions);

        // add admin gig sponsor role
        $gigSponsorRole = Role::create(['name' => 'gig sponsor']);
        // add permissions for gig sponsor
        $gigSponsorRole->givePermissionTo($gigSponsorPermissions);
        $gigSponsorRole->givePermissionTo($gigParticipantPermissions);

        // add admin gig participant role
        $gigParticipantRole = Role::create(['name' => 'gig participant']);
        // add permissions for gig participant
        $gigParticipantRole->givePermissionTo($gigParticipantPermissions);
    }

    private function addCategories(){
        DB::table('categories')->insert([
            'name' => 'Digital Marketing',
            'icon_path' => '/images/categories/digital_marketing_icon.png',
            'color' => 'yellow-blue'
        ]);
        DB::table('categories')->insert([
            'name' => 'Graphics and Design',
            'icon_path' => '/images/categories/graphics_and_design_icon.png',
        ]);
        DB::table('categories')->insert([
            'name' => 'Tech and Development',
            'icon_path' => '/images/categories/tech_and_development_icon.png',
        ]);
        DB::table('categories')->insert([
            'name' => 'Writing and Translation',
            'icon_path' => '/images/categories/writing_and_translation_icon.png',
        ]);
        DB::table('categories')->insert([
            'name' => 'Data Analysis',
            'icon_path' => '/images/categories/data_analysis_icon.png',
        ]);
    }

    private function addSkills(){
        $skills = array(
            'French',
            'Spanish',
            'Blog Content',
            'Social Media',
            'WordPress',
            'Drupal',
            'Web Design',
            'Salesforce',
            'Confluence',
            'Agile',
            'Aha!',
            'Rally',
            'Python',
            'SQL',
            'Laravel',
            'Creative Cloud',
            'Speechwriting',
            'Proofreading',
            'Editing',
            'Sales Strategy',
            'Project Management',
            'CRM',
            'Explainer Videos',
            'Animation',
            'Forecasting',
            'Excel',
            'SmartSheet',
            'Pivot Tables',
            'jQuery',
            'Data Lake',
            'Marketing',
            'Finance',
            'Visualization',
            'Tableau',
            'Data Mining',
            'Logo Design',
            'Design Thinking',
            'Print Media',
            'Icon Design',
            'Jenkins',
            'PHP',
            'DevOps',
            'Testing',
            'UI Decoupling',
            'UX/UI',
            'User Experience',
            'User Interface',
            'Javascript',
            'HTML',
            'CSS',
            'Prototyping',
            'Graphic Design',
            'Wireframes',
            'Axure',
            'InVision',
            'Channel Marketing',
            'QMI',
            'Research',
            'Accounting',
            'Project Finance',
            'Supply Chain',
            'Sourcing',
            'SaaS',
            'Full-Stack',
            'Back-end',
            'Front-end',
            'Communication',
            'Audit',
            'Data Processing',
            'Cost Reduction',
            'Compliance',
            'Econometrics',
            'Statistical Analysis',
            'R',
            'MatLab',
            'GAAP',
            'Mergers',
            'Acquisitions',
            'M&A',
            'Financial Modeling',
            'Profit and Loss',
            'Quantitative Analysis',
            'Qualitative Analysis',
            'Reconciliation',
            'Restructuring',
            'ERP',
            'Data Quality',
            'Strategic Planning',
            'Risk Management',
            'Tax',
            'Wealth Management',
            'Valuations',
            'Reporting',
            'Dashboards',
            'Securities',
            'Bonds',
            'Risk Analysis',
            'Portfolio Management',
            'FinTech',
            'Product Development',
            'Product Management',
            'Product Testing',
            'User Testing',
            'Market Testing',
            'Documentation',
            'Legal',
            'PowerPoint',
            'Keynote',
            'Systems Design',
            'Cyber Security',
            'Architecture',
            'Cloud Security',
            'AWS',
            'Networks',
            'Ruby',
            'Automation',
            'Six Sigma',
            'LEAN',
            'Process Engineering',
            'Consulting',
            'Data Cleaning',
            'Enterprise Architecture',
            'Solutions Architecture',
            'Proof of Concept',
            'MVP',
            'Scrum'
        );
        foreach ($skills as $skillName){
            $skill = ['name' => $skillName];
            Skill::create($skill);
        }
    }
}