# Push to GitHub - Quick Guide

## Option 1: Push to New Repository (Recommended)

### Step 1: Create Repository on GitHub

1. Go to https://github.com/new
2. Repository name: `microsoft-marketplace`
3. Description: "White-label Microsoft CSP marketplace with multi-country support"
4. **Keep it Private** (recommended for client work)
5. **Do NOT initialize** with README, .gitignore, or license
6. Click "Create repository"

### Step 2: Push from Your Local Machine

```bash
# Navigate to the project
cd microsoft-marketplace

# Initialize Git
git init

# Add all files
git add .

# Make first commit
git commit -m "Initial commit: Complete Microsoft Marketplace application"

# Add your GitHub repository as remote
# Replace YOUR_USERNAME with your GitHub username
git remote add origin https://github.com/YOUR_USERNAME/microsoft-marketplace.git

# Push to GitHub
git branch -M main
git push -u origin main
```

**That's it!** Your code is now on GitHub.

---

## Option 2: Using SSH (If you have SSH keys configured)

```bash
cd microsoft-marketplace
git init
git add .
git commit -m "Initial commit: Complete Microsoft Marketplace application"

# Use SSH URL instead
git remote add origin git@github.com:YOUR_USERNAME/microsoft-marketplace.git
git branch -M main
git push -u origin main
```

---

## Option 3: Using GitHub CLI (If installed)

```bash
cd microsoft-marketplace

# Login to GitHub
gh auth login

# Create and push repository
gh repo create microsoft-marketplace --private --source=. --push

# Done!
```

---

## If You Get Authentication Errors

### For HTTPS:
GitHub no longer accepts passwords. Use a Personal Access Token:

1. Go to https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Give it a name: "Microsoft Marketplace"
4. Select scopes: `repo` (all)
5. Generate token
6. Copy the token
7. When pushing, use the token as your password

### Better: Configure Git Credential Helper

```bash
# Store credentials (HTTPS)
git config --global credential.helper store

# Or for Mac
git config --global credential.helper osxkeychain

# Or for Windows
git config --global credential.helper wincred
```

---

## Post-Push Setup

### Add Collaborators
1. Go to your repository on GitHub
2. Click Settings > Collaborators
3. Add team members

### Setup Branches
```bash
# Create development branch
git checkout -b development
git push -u origin development

# Create staging branch
git checkout -b staging
git push -u origin staging

# Back to main
git checkout main
```

### Protect Main Branch
1. Repository > Settings > Branches
2. Add branch protection rule for `main`
3. Enable "Require pull request reviews"

---

## Future Updates

After making changes:

```bash
# Check what changed
git status

# Add changes
git add .

# Commit with message
git commit -m "Description of changes"

# Push to GitHub
git push
```

---

## Clone on Another Machine

```bash
# Clone the repository
git clone https://github.com/YOUR_USERNAME/microsoft-marketplace.git

# Navigate into it
cd microsoft-marketplace

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
php artisan migrate

# You're ready!
```

---

## Common Git Commands

```bash
# See status
git status

# See commit history
git log --oneline

# Create new branch
git checkout -b feature-name

# Switch branches
git checkout main

# Pull latest changes
git pull

# See remotes
git remote -v

# Add specific files
git add filename.php

# Undo changes (before commit)
git checkout -- filename.php

# View differences
git diff
```

---

## .gitignore Already Configured

The following are excluded from Git:
- `/vendor` (Composer packages)
- `/node_modules` (NPM packages)
- `.env` (Environment variables - **NEVER commit this!**)
- `/storage` logs and cache
- IDE files (.vscode, .idea)
- OS files (.DS_Store)

---

## Environment Variables for GitHub Actions (Optional)

If you want automated deployments:

1. Repository > Settings > Secrets and variables > Actions
2. Add secrets:
   - `MICROSOFT_TENANT_ID`
   - `MICROSOFT_CLIENT_ID`
   - `MICROSOFT_CLIENT_SECRET`
   - `MTN_MOMO_API_KEY`
   - etc.

---

## Quick Reference

```bash
# Your typical workflow:
git pull                                    # Get latest changes
# Make your changes...
git add .                                   # Stage changes
git commit -m "Add new feature"            # Commit
git push                                    # Push to GitHub

# When starting new feature:
git checkout -b feature-name               # Create feature branch
# Work on feature...
git push -u origin feature-name            # Push feature branch
# Create Pull Request on GitHub
# After merge, back to main:
git checkout main
git pull                                   # Get merged changes
```

---

## Need Help?

- GitHub Docs: https://docs.github.com/
- Git Cheat Sheet: https://education.github.com/git-cheat-sheet-education.pdf
- Learn Git Branching: https://learngitbranching.js.org/

---

**Note**: Make sure `.env` is in `.gitignore` (it is) - NEVER commit API keys or secrets to GitHub!
