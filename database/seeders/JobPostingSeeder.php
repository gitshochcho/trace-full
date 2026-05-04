<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\JobPosting::create([
            'title' => 'Trade Facilitation Consultant',
            'description' => '<p>We are looking for an experienced trade facilitation consultant to support our growing portfolio of WTO TFA implementation, customs modernisation, and border management reform projects across South Asia.</p>
            
            <p>Beyond project implementation, you will be responsible for conducting gap analyses, drafting policy recommendations, and facilitating high-level stakeholder consultations with government agencies and private sector trade bodies.</p>

            <p>The role requires a deep understanding of international trade laws, regional economic integration, and the ability to translate complex regulatory requirements into actionable business processes.</p>

            <h4>Key Responsibilities:</h4>
            <ul>
                <li>Conduct comprehensive trade process mapping and simplification</li>
                <li>Develop strategic roadmaps for WTO TFA compliance</li>
                <li>Provide technical assistance to customs authorities</li>
                <li>Liaise with international development partners</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Master\'s degree in International Trade, Economics, or related field</li>
                <li>4+ years of experience in trade facilitation or customs reform</li>
                <li>Strong analytical and communication skills</li>
                <li>Experience with WTO TFA implementation preferred</li>
            </ul>',
            'department' => 'Trade & Policy Division',
            'employment_type' => 'Full-Time',
            'location' => 'Dhaka, Bangladesh',
            'experience_level' => '4+ years experience',
            'is_active' => true,
            'posted_date' => now()->subDays(30),
        ]);

        \App\Models\JobPosting::create([
            'title' => 'Full-Stack Developer — Trade Systems',
            'description' => '<p>Seeking a full-stack developer with experience in government systems, LIMS, or trade platform development. You will be responsible for designing, developing, and maintaining web-based applications that support trade facilitation and customs processes.</p>

            <p>This role involves working closely with our trade consultants to understand business requirements and translate them into technical solutions that improve efficiency and compliance.</p>

            <h4>Key Responsibilities:</h4>
            <ul>
                <li>Develop and maintain web applications using Laravel and Vue.js</li>
                <li>Design and implement database schemas for trade systems</li>
                <li>Integrate with government APIs and external systems</li>
                <li>Ensure security and compliance standards are met</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Bachelor\'s degree in Computer Science or related field</li>
                <li>2-4 years of experience in full-stack development</li>
                <li>Proficiency in PHP, Laravel, JavaScript, and SQL</li>
                <li>Experience with government or enterprise systems preferred</li>
            </ul>',
            'department' => 'Technology Solutions',
            'employment_type' => 'Contract',
            'location' => 'Dhaka / Remote',
            'experience_level' => '2–4 years experience',
            'is_active' => true,
            'posted_date' => now()->subDays(45),
        ]);

        \App\Models\JobPosting::create([
            'title' => 'Research & Assessments Analyst',
            'description' => '<p>A rigorous analyst to support trade facilitation needs assessments, economic impact studies, and value chain analyses for government and donor clients. Strong quantitative and qualitative research skills required.</p>

            <p>You will conduct field research, analyze trade data, and produce high-quality reports that inform policy decisions and project designs.</p>

            <h4>Key Responsibilities:</h4>
            <ul>
                <li>Conduct trade facilitation needs assessments</li>
                <li>Perform economic impact analysis and cost-benefit studies</li>
                <li>Analyze trade and customs data using statistical tools</li>
                <li>Prepare technical reports and policy recommendations</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Master\'s degree in Economics, Statistics, or related field</li>
                <li>2-4 years of research experience</li>
                <li>Proficiency in statistical software (R, Stata, SPSS)</li>
                <li>Strong analytical and writing skills</li>
            </ul>',
            'department' => 'Research & Evaluation',
            'employment_type' => 'Full-Time',
            'location' => 'Dhaka, Bangladesh',
            'experience_level' => '2–4 years experience',
            'is_active' => true,
            'posted_date' => now()->subDays(60),
        ]);

        \App\Models\JobPosting::create([
            'title' => 'Laboratory Quality & Accreditation Specialist',
            'description' => '<p>Experienced ISO/IEC 17025 specialist to support our laboratory accreditation advisory projects. You\'ll guide public and private lab clients through QMS development, gap analysis, and assessment preparation.</p>

            <p>This role involves working with laboratory managers to implement quality management systems, prepare for accreditation audits, and ensure compliance with international standards.</p>

            <h4>Key Responsibilities:</h4>
            <ul>
                <li>Conduct laboratory quality management system assessments</li>
                <li>Develop QMS documentation and procedures</li>
                <li>Prepare laboratories for ISO/IEC 17025 accreditation</li>
                <li>Provide training on quality assurance practices</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Degree in Chemistry, Biology, or related scientific field</li>
                <li>5+ years of laboratory quality management experience</li>
                <li>ISO/IEC 17025 expertise and lead auditor certification preferred</li>
                <li>Experience with laboratory information management systems</li>
            </ul>',
            'department' => 'Laboratory Services',
            'employment_type' => 'Contract',
            'location' => 'Dhaka, Bangladesh',
            'experience_level' => '5+ years experience',
            'is_active' => true,
            'posted_date' => now()->subDays(15),
        ]);

        \App\Models\JobPosting::create([
            'title' => 'Junior Project Coordinator',
            'description' => '<p>An organised, proactive junior coordinator to support our project management team across multiple simultaneous engagements. Ideal for someone early in their development consulting career.</p>

            <p>You will assist with project planning, stakeholder coordination, reporting, and administrative tasks to ensure smooth project execution.</p>

            <h4>Key Responsibilities:</h4>
            <ul>
                <li>Assist with project planning and scheduling</li>
                <li>Coordinate meetings and stakeholder communications</li>
                <li>Prepare project reports and documentation</li>
                <li>Support project monitoring and evaluation activities</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Bachelor\'s degree in Business, Development Studies, or related field</li>
                <li>0-2 years of project coordination experience</li>
                <li>Strong organizational and communication skills</li>
                <li>Proficiency in Microsoft Office suite</li>
            </ul>',
            'department' => 'Project Management Office',
            'employment_type' => 'Full-Time',
            'location' => 'Dhaka, Bangladesh',
            'experience_level' => '0–2 years experience',
            'is_active' => true,
            'posted_date' => now()->subDays(7),
        ]);
    }
}
