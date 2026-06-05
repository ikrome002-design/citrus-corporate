# Citrus Labs Limited Corporate Website

Official corporate website for **Citrus Labs Limited**, a technology company focused on building modern, scalable, secure, and commercially viable digital platforms for businesses, institutions, and sector-specific operations.

This website presents the company’s identity, product ecosystem, services, innovation philosophy, technical capability, and contact pathways for partners, clients, investors, and stakeholders.

---

## Table of Contents

- [About Citrus Labs Limited](#about-citrus-labs-limited)
- [Project Overview](#project-overview)
- [Purpose of the Website](#purpose-of-the-website)
- [Key Website Sections](#key-website-sections)
- [Product Ecosystem](#product-ecosystem)
- [Core Features](#core-features)
- [Recommended Tech Stack](#recommended-tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Environment Variables](#environment-variables)
- [Available Scripts](#available-scripts)
- [Development Standards](#development-standards)
- [Security Guidelines](#security-guidelines)
- [Performance Guidelines](#performance-guidelines)
- [SEO Guidelines](#seo-guidelines)
- [Accessibility Guidelines](#accessibility-guidelines)
- [Testing](#testing)
- [Deployment](#deployment)
- [Git Workflow](#git-workflow)
- [License](#license)
- [Maintainer](#maintainer)

---

## About Citrus Labs Limited

**Citrus Labs Limited** is a software innovation company focused on designing and developing modern digital platforms, SaaS products, and business systems.

The company’s work centers around:

- SaaS product development
- Business process digitization
- Healthcare technology
- Transport technology
- Sales enablement systems
- Merchant and service-provider platforms
- Administrative dashboards
- Secure user account systems
- Digital workflow automation
- Modern web application architecture

Citrus Labs Limited builds products intended to help organizations operate with better structure, visibility, governance, automation, and digital efficiency.

---

## Project Overview

This repository contains the source code for the **Citrus Labs Limited Corporate Website**.

The website acts as the company’s primary public-facing digital presence. It communicates what Citrus Labs Limited does, the products it builds, the industries it serves, and how potential customers or partners can contact the company.

This is not a general open-source software package. It is a corporate brand and business website representing Citrus Labs Limited’s commercial identity and intellectual property.

---

## Purpose of the Website

The website is designed to:

1. Present Citrus Labs Limited as a serious technology company.
2. Showcase the company’s SaaS and software product ecosystem.
3. Explain the company’s technical capability and innovation direction.
4. Provide a clear overview of services and platforms.
5. Create a professional contact point for clients, partners, schools, clinics, merchants, institutions, and other organizations.
6. Support credibility when sharing the company online, including through GitHub, proposals, and business development conversations.
7. Communicate the company’s product-building philosophy: precise, evidence-based, scalable, and secure.

---

## Key Website Sections

The corporate website may include the following pages or sections:

### 1. Home

The main landing page introducing Citrus Labs Limited.

Suggested content:

- Hero headline
- Company tagline
- Brief company description
- Product highlights
- Services overview
- Call-to-action buttons
- Featured platforms
- Contact prompt

---

### 2. About

A page describing the company’s background, mission, values, and technical direction.

Suggested content:

- Who Citrus Labs Limited is
- What the company builds
- Founder-led product vision
- SaaS innovation focus
- Business and technology philosophy
- Company values

---

### 3. Products

A portfolio section showing the major Citrus Labs Limited platforms.

Suggested products:

- Citrus
- Curis by Citrus
- Safiri by Citrus
- Scribble by Citrus
- Edge by Citrus
- Servana by Citrus
- Rideon by Citrus
- CarPal
- Other active or planned Citrus Labs Limited products

---

### 4. Services

A section explaining what Citrus Labs Limited can provide to customers or partners.

Possible services:

- Custom SaaS development
- Web application development
- Platform architecture
- Admin dashboard development
- Business workflow automation
- Database-backed system design
- API integration
- Product prototyping
- UI/UX design
- Cloud-ready software development
- Maintenance and platform improvement

---

### 5. Industries

A section showing the sectors Citrus Labs Limited targets.

Possible industries:

- Healthcare
- Education
- Transport
- Retail
- Automotive services
- Merchant services
- Public-sector systems
- SMEs and growing businesses

---

### 6. Technology

A section describing the company’s preferred technical standards.

Suggested technologies:

- Laravel
- PHP
- JavaScript ES6+
- TypeScript
- Vue.js
- React.js
- Tailwind CSS
- Bootstrap 5
- MySQL
- PostgreSQL
- REST APIs
- GraphQL
- Laravel Sanctum
- Laravel Passport

---

### 7. Contact

A contact section or page for business inquiries.

Suggested fields:

- Full name
- Email address
- Phone number
- Company or organization
- Inquiry type
- Message
- Consent checkbox
- Submit button

---

## Product Ecosystem

The corporate website may reference the following products from the Citrus Labs Limited ecosystem.

### Citrus

A broader SaaS platform concept supporting different types of business and institutional accounts, administrative controls, user management, billing workflows, and operational dashboards.

---

### Curis by Citrus

A healthcare management platform designed to connect clinics, patients, and healthcare-related service providers through digital workflows.

Curis includes concepts such as:

- Clinic accounts
- Patient accounts
- Doctor accounts
- Receptionist or clinic assistant accounts
- Medical records
- Appointment management
- Prescriptions
- Billing
- Service charge handling
- Platform administration
- Secure communication

---

### Safiri by Citrus

A school transport management system designed to help schools manage student transport operations, parents, routes, payments, and transport-related administration.

---

### Scribble by Citrus

A SaaS platform under the Citrus Labs Limited product ecosystem. It may be presented as part of the company’s broader portfolio of internally developed platforms.

---

### Edge by Citrus

A sales enablement and sales personnel management platform designed to support product registration, sales tracking, user onboarding, and multi-SaaS integration workflows.

---

### Servana by Citrus

A service-focused SaaS platform under the Citrus Labs Limited ecosystem, intended to support structured digital service delivery and business workflows.

---

### Rideon by Citrus

A transport or mobility-related platform within the Citrus Labs Limited product portfolio.

---

### CarPal

An automotive service management platform concept focused on auto repair shops, vehicle check-in/check-out workflows, invoices, customer communication, and service records.

---

## Core Features

The corporate website should include:

- Responsive landing page
- Clear company introduction
- Product showcase section
- Services section
- Contact form
- Product cards
- Call-to-action buttons
- Modern navigation
- Mobile-first layout
- SEO-friendly metadata
- Fast-loading assets
- Accessible typography
- Structured footer
- Privacy policy link
- Terms of service link
- GitHub-ready documentation
- Clean reusable components
- Secure configuration handling

---

## Recommended Tech Stack

This website should follow the company’s modern web application direction.

### Backend

- Laravel
- PHP 8.2 or newer recommended
- REST API where needed
- Laravel Sanctum or Passport where authentication is required

### Frontend

Use one of the following:

- Vue.js
- React.js

Recommended language:

- JavaScript ES6+
- TypeScript where practical

### Styling

Use one of the following:

- Tailwind CSS
- Bootstrap 5

### Database

Use one of the following where database storage is required:

- MySQL
- PostgreSQL

### Build Tooling

Recommended:

- Vite
- npm, pnpm, or yarn

### Avoid

Do not use jQuery for this project unless maintaining legacy code that already depends on it.

---

## Project Structure

Recommended structure for a Laravel + modern frontend implementation:

```text
citrus-corporate-website/
├── app/
│   ├── Http/
│   ├── Models/
│   └── Services/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── assets/
│   ├── favicon.ico
│   └── index.php
├── resources/
│   ├── css/
│   ├── js/
│   │   ├── components/
│   │   ├── layouts/
│   │   ├── pages/
│   │   └── app.js
│   └── views/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── tests/
│   ├── Feature/
│   └── Unit/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── README.md
└── vite.config.js
