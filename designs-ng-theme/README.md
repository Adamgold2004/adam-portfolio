# Adam Studio Custom WordPress Theme

A premium, modern WordPress theme built specifically for Adam Studio. This theme provides the foundational structure, custom post types, and GSAP animations needed to create a high-end agency website using Elementor Pro.

## Features
- **Elementor Pro Ready:** Fully compatible with Elementor Theme Builder (Header, Footer, Single Post, Archive).
- **Custom Post Types:** Pre-configured CPTs for `Projects`, `Team`, and `Services` so they can be managed dynamically.
- **GSAP Animations:** High-performance, cinematic animations pre-loaded and ready to be triggered via Elementor CSS classes.
- **Lightweight & Optimized:** Minimal CSS/JS footprint; relies on Elementor for layout and design.

---

## Installation

1. Zip the `designs-ng-theme` folder.
2. In your WordPress Admin dashboard, go to **Appearance > Themes > Add New > Upload Theme**.
3. Upload the `.zip` file and click **Install Now**, then **Activate**.
4. Ensure **Elementor** and **Elementor Pro** plugins are installed and activated.

---

## Setting up Elementor & Theme Builder

Because this theme provides a blank canvas, you must use **Elementor Theme Builder** to create your global templates:
1. **Header:** Go to Templates > Theme Builder > Header. Create a new Header and set the display condition to "Entire Site".
2. **Footer:** Go to Templates > Theme Builder > Footer. Create a new Footer and set the display condition to "Entire Site".
3. **Single Project:** Go to Templates > Theme Builder > Single Post (or Single Project). Design the layout for individual portfolio items using Elementor's Dynamic Tags to pull the Title, Featured Image, Excerpt, and Post Content.

---

## Adding Content

### Projects (Portfolio)
1. Go to **Projects > Add New** in the WordPress admin menu.
2. Enter the project title, upload a Featured Image, and add the main content in the editor (or using Elementor).
3. Select a **Project Category** (e.g., Branding, Website Development).
4. *(Optional)* Add custom fields if you wish to track specific metadata like "Client" or "Year" (you can use Advanced Custom Fields for easier management).
5. Publish.

### Team Members & Services
Follow the same process under the **Team** and **Services** admin menus.

---

## Activating GSAP Animations in Elementor

To trigger the cinematic GSAP animations built into this theme, you just need to add specific **CSS Classes** to your Elementor widgets, columns, or sections. 

In Elementor, click on the element, go to the **Advanced** tab, and enter the class name in the **CSS Classes** field (without the dot).

### 1. Portfolio Horizontal Swipe + 3D Tilt
To create the horizontal scrolling portfolio section on the homepage:
- **Section Class:** Give the main Elementor Section/Container the class: `portfolio-swipe-section`.
- **Wrapper Class:** Inside that section, if using a Loop Grid or Posts widget, ensure the wrapper containing the items gets the class: `portfolio-cards-wrapper`. *(Note: You may need to add this class to the Loop Grid widget itself)*.
- **Card Class:** Ensure each individual project card template (created in Elementor Theme Builder for the Loop) has the class: `portfolio-card`.

### 2. Team Members Animation (Fade Up + Hover)
To animate team members appearing as you scroll:
- **Section Class:** Give the section containing the team members the class: `team-section`.
- **Member Class:** Give each team member column or container the class: `team-member`.

### 3. Cinematic Text Reveal
To make any heading or text block slide up and fade in smoothly as you scroll to it:
- **Text Class:** Give the Heading or Text Editor widget the class: `reveal-text`.
