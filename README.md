# Expired Education 🎓

> **Discover what science has learned since you were in school**

An interactive web application that shows users how scientific knowledge and "facts" have evolved since their graduation year. See the fascinating contrast between what you learned in school and what we know now!

## 🌟 What This App Does

**Expired Education** reveals how much scientific understanding has changed since you finished school. Simply enter your graduation year, and discover:

- **What you learned in school** - The "facts" that were taught as established science
- **What we know now** - How our understanding has evolved and been corrected
- **When things changed** - The timeline of scientific discoveries and corrections

## 🚀 Features

### 📅 Personalized Timeline
- Enter your graduation year (1901-present)
- See discoveries and corrections made after your school years
- Understand how much knowledge has evolved since then

### 📚 Comprehensive Fact Database
Our database contains **90 educational facts** covering:
- **Science**: Physics, chemistry, biology misconceptions
- **Health**: Nutrition myths, medical misinformation  
- **Technology**: Failed predictions about computers and internet
- **Geography**: Outdated geographical knowledge
- **History**: Corrected historical narratives
- **Environment**: Climate and ecological understanding

### 🎨 Beautiful Interface
- Clean, modern design with intuitive navigation
- **Red sections**: Outdated information taught in schools
- **Green sections**: Current scientific understanding
- Timeline and card-based layouts for easy browsing

### 🔍 Multiple Views
- **Homepage**: Interactive year selection
- **Personal Timeline**: Facts that changed since your graduation
- **Complete Timeline**: Chronological view of all discoveries
- **Admin Panel**: Content management system

## 🛠️ Technical Stack

### Backend
- **Laravel 12** (PHP 8.2+)
- **SQLite Database** with comprehensive fact storage
- **Filament Admin Panel** for content management
- **Spatie Packages** for tags and media handling

### Frontend
- **Livewire** for interactive components
- **Tailwind CSS** for responsive styling
- **Blade Templates** for server-side rendering

### Key Features
- **Caching** for optimal performance
- **Version Control** for fact updates
- **Import/Export** functionality
- **Tag System** for categorization
- **Responsive Design** for all devices

## 🏗️ Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd expirededucation
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see the application!

## 📊 Database Structure

### Facts Table
Each educational fact contains:
- **Title**: The misconception or outdated fact
- **Content Old**: What was actually taught in schools
- **Content New**: Current scientific understanding
- **Started At**: When the old teaching began
- **Ended At**: When it was corrected/updated
- **Tags**: Subject categories
- **Attribution**: Sources and references
- **Version Control**: Track fact updates over time

## 🎯 User Experience

1. **Landing Page**: User selects their graduation year
2. **Results Page**: Personalized list of facts that changed since school
3. **Fact Cards**: Side-by-side comparison of old vs. new knowledge
4. **Timeline View**: Browse all discoveries chronologically
5. **Admin Panel**: Manage and update fact database

## 🎓 Educational Value

This application demonstrates:
- **Scientific Evolution**: How knowledge continuously improves
- **Critical Thinking**: Why we should question "established facts"
- **Lifelong Learning**: The importance of staying updated
- **Historical Context**: Understanding how education has changed

Perfect for:
- **Educators** showing students how science evolves
- **Students** understanding the nature of scientific knowledge
- **Anyone curious** about how much has changed since their school days
- **Science communicators** illustrating knowledge evolution

## 🔧 Development

### Running in Development Mode
```bash
composer run dev
```

This starts:
- Laravel development server
- Queue worker
- Log monitoring
- Vite asset compilation

### Testing
```bash
composer run test
```

### Code Style
```bash
./vendor/bin/pint
```

## 📝 Contributing

We welcome contributions! Whether it's:
- Adding new facts to the database
- Improving the user interface
- Fixing bugs or adding features
- Updating documentation

Please feel free to submit issues and pull requests.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- Admin panel powered by [Filament](https://filamentphp.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Icons and design inspiration from the scientific community

---

**Remember**: Science is always evolving. These facts represent our current understanding and may continue to be refined as we learn more! 🔬✨
