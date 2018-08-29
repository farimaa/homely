<?php

use Illuminate\Database\Seeder;
use \App\Models\Article;
use \App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
    		[	
    			'title' => 'راهکارهای علمی برای پیش بینی آینده کسب وکار',
	        	'content' => 'موضوع عجیبی نیست اگر بشنویم مدیریت شرکتی در مورد پیش بینی های کسب وکارش صحبت کند: «فروش ما با ارقام پیش بینی شده همخوانی ندارد» یا «رشد اقتصادی پیش بینی شده برای ما مناسب است و انتظار می رود به اهدافمان برسیم.» به هر حال، باید بدانیم که کلیه پیش بینی های مالی، چه در مورد ویژگی های یک کسب وکار مانند رشد فروش باشد، چه در مورد وضعیت کلی اقتصاد، حدس هایی بر اساس آگاهی های ما هستند.

روش های پیش بینی مالی برای شرکت ها
کلیه روش هایی که بر اساس آن می توان آینده کسب وکاری را پیش بینی کرد، تحت دو رویکرد غالب «کیفی» و «کمی» قرار می گیرند.

مدل های کیفی
مدل های کیفی به طور کلی برای پیش بینی های کوتاه مدت که دامنه پیش بینی محدود است، موفق بوده اند. پیش بینی های کیفی تخصص-محور هستند و کارشناسان بازار بر اساس اتفاق آرا این پیش بینی ها را انجام می دهند. مدل های کیفی در پیش بینی موفقیت کوتاه مدت شرکت ها، محصولات و خدمات آنها کاربرد دارند، اما با توجه به اتکا بر داده های قابل اندازه گیری، با محدودیت هایی روبه رو هستند. مدل های کیفی عبارتند از: مدل تحقیق بازار: نظرسنجی از طیف گسترده ای از مردم در مورد یک کالا یا خدمات خاص، به منظور پیش بینی اینکه چه تعدادی از مردم این کالا یا خدمات را خریداری می کنند. مدل دلفی: پرسش از کارشناسان یک حوزه مشخص و جمع آوری نظرات آنان و استفاده از این نظرات برای انجام پیش بینی.

مدل های کمی
مدل های کمی نظرات کارشناسی را در نظر نمی گیرند و سعی می کنند عوامل انسانی را از تحلیل ها خارج کنند. این رویکرد تنها بر اساس داده های موجود شکل می گیرد و بی ثباتی موجود در نظرات انسان را با تاکید بر عدد و رقم از بین می برد. همچنین در جایی که متغیرهایی مانند فروش، تولید ناخالص داخلی، قیمت مسکن و غیره در بلند مدت اندازه گیری می شوند، این مدل برای پیش بینی مورد استفاده قرار می گیرد. مدل های کمی عبارتند از: رویکرد شاخص: این رویکرد به رابطه بین شاخص های مشخص، به طور مثال نرخ رشد تولید داخلی و بیکاری بستگی دارد که تقریبا در طول یک دوره مشخص بدون تغییر باقی می مانند. با پیگیری این رابطه و سپس پیگیری داده های شاخص های پیشتاز، می توان عملکرد شاخص های عقب مانده را تخمین زد. مدل سازی اقتصادسنجی: این روش نوعی از رویکرد شاخص است که بیشتر از مدل های ریاضی استفاده می کند. به جای اینکه فرض کنیم روابط بین شاخص ها ثابت است، مدل سازی اقتصادسنجی، هماهنگی درونی مجموعه داده ها را در طول زمان و اهمیت یا قدرت رابطه موجود بین مجموعه داده ها آزمایش می کند. روش های سری زمانی: این روش به مجموعه روش شناسی های مختلفی اتلاق می شود که از داده های گذشته برای پیش بینی وقایع آینده استفاده می کنند. در این روش فرد پیش بینی کننده با دنبال کردن وقایع گذشته می تواند پیش بینی بالاتر از حد متوسطی در مورد آینده داشته باشد. این مدل متداول ترین نوع پیش بینی برای کسب وکار است، چون هم ارزان است و هم مزیت یا محدودیتی نسبت به سایر روش ها ندارد.

چالش پیش بینی کسب وکار
پیش بینی برای کسب وکار برای شرکت ها و بنگاه های اقتصادی بسیار مفید است، چون امکان برنامه ریزی تولید، تامین مالی و غیره را برای آنها به وجود می آورد. اما سه مشکل بر سر راه این پیش بینی ها وجود دارد: ۱) داده ها همیشه در معرض کهنه شدن هستند. داده های قدیمی همه آن چیزی است که ما برای پیش بینی کردن در اختیار داریم و هیچ تضمینی وجود ندارد که شرایط گذشته در آینده هم تکرار شود. ۲) در نظر گرفتن وقایع منحصر به فرد، غیرقابل انتظار یا پیامدهای خارجی غیرممکن است. فرضیات هم می توانند خطرناک باشند. ۳) پیش بینی ها نمی توانند اثر خود را کامل کنند. اقدامات کسب وکارها با پیش بینی کردن، چه این پیش بینی دقیق باشد چه ناقص، تحت تاثیر فاکتوری قرار می گیرد که نمی توان آن را یک متغیر به حساب آورد. در یک سناریوی بدتر، مدیریت سازمان به جای اینکه نگران عملکرد کسب وکار در زمان حال باشد، بنده داده ها و روندهای قدیمی می شود.  

',
	        	'category_id' => null,
	        	'user_id' => 1,
	        	'status' => Article::STATUS_ACTIVE,
	        	'image_id' => 1,
	        ]
        ];
        $category = Category::where('type',Category::TYPE_ARTICLE)->first();
        foreach($articles as $article)
        {
        	$article['category_id'] = $category->id;
        	$article['user_id'] = 1;
	        Article::firstOrCreate($article);
        }
    }
}
