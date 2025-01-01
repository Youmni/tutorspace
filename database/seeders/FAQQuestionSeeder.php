<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FAQQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faq_questions')->insert([
            ['question' => 'What is this platform about?', 'answer' => 'This platform provides educational courses and resources.', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'How can I contact support?', 'answer' => 'You can contact support through the "Contact Us" page.', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Is this platform free?', 'answer' => 'Some courses are free, while others require a subscription.', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Can I suggest a feature?', 'answer' => 'Yes, you can suggest features via the feedback form.', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Where can I find the terms of service?', 'answer' => 'You can find the terms of service in the footer section.', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            ['question' => 'How do I enroll in a course?', 'answer' => 'Click on the course and follow the enrollment instructions.', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Are there any prerequisites for courses?', 'answer' => 'Some courses may require prior knowledge, which is mentioned in the description.', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Can I access courses offline?', 'answer' => 'Currently, courses are only available online.', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'What happens if I miss a live session?', 'answer' => 'Recordings of live sessions are available.', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Can I get a certificate?', 'answer' => 'Certificates are provided for certain courses upon completion.', 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            
            ['question' => 'How do I reset my password?', 'answer' => 'Use the "Forgot Password" link on the login page.', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'How can I change my email address?', 'answer' => 'Go to your account settings to update your email.', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'How do I cancel my subscription?', 'answer' => 'You can cancel your subscription in the billing section of your account.', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Can I get a refund?', 'answer' => 'Refund policies are outlined in the billing section.', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Why was my account suspended?', 'answer' => 'Accounts may be suspended for violating terms of service.', 'category_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
