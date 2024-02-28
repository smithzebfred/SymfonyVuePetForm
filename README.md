# Pet Owner Registration
This project is a Pet Owner registration experience with a frontend form inspired by the provided UI mocks.  The frontend is developed using Vue.js 3 and backend is developed using symfony latest.

## Prerequisites
- Node.js and npm installed on your machine
- Vue CLI is a command-line
- PHP installed on your machine
- Composer installed on your machine
- Symfony CLI installed on your machine


## Getting Started
- Clone the repository:`git clone https://github.com/zainbinabid55/SymfonyVuePetForm.git`
- Navigate to backend folder :```cd pet-service-backend```.
- Set environment variable :```cp .env.example .env``` and edit the required environment variables
- Install dependencies using Composer: `composer install`
- Start the Symfony development server: `symfony server:start`
- Navigate to frontend folder: ```cd ../pet-service-frontend```
- Set Backend url:Open src/services/SymphonyService.js file.Find the baseURL configuration and replace 'http://127.0.0.1:8000' with the actual URL where the Symfony server is running.
- Install Node.js dependencies:  `npm install`
- Start the Vue.js development server: `npm run serve`

