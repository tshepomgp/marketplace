# Manual GitHub Push - Step by Step

If you prefer to do it manually (or the script didn't work), follow these exact steps:

## Prerequisites

You need:
- ✅ Git installed on your computer
- ✅ GitHub account
- ✅ Terminal/Command Prompt access

---

## Step 1: Create Repository on GitHub

1. Open browser and go to: **https://github.com/new**

2. Fill in the form:
   - **Repository name**: `microsoft-marketplace`
   - **Description**: "White-label Microsoft CSP marketplace"
   - **Visibility**: Select **Private** (recommended)
   - **⚠️ IMPORTANT**: Do **NOT** check any of these:
     - ❌ Add a README file
     - ❌ Add .gitignore
     - ❌ Choose a license

3. Click **"Create repository"**

4. **Keep this page open** - you'll need the URL shown

---

## Step 2: Open Terminal and Navigate to Project

```bash
# On Mac/Linux - Open Terminal
# On Windows - Open Command Prompt or PowerShell

# Navigate to the microsoft-marketplace folder
cd path/to/microsoft-marketplace

# For example:
cd ~/Downloads/microsoft-marketplace
# or
cd C:\Users\YourName\Downloads\microsoft-marketplace
```

---

## Step 3: Initialize Git

Copy and paste these commands **one by one**:

```bash
# Initialize Git repository
git init
```

You should see: `Initialized empty Git repository in ...`

---

## Step 4: Configure Git (First Time Only)

If this is your first time using Git:

```bash
# Set your name
git config --global user.name "Your Name"

# Set your email (use your GitHub email)
git config --global user.email "your.email@example.com"
```

---

## Step 5: Add All Files

```bash
# Add all files to Git
git add .
```

This stages all files for commit. You won't see any output, which is normal.

---

## Step 6: Create First Commit

```bash
# Create the first commit
git commit -m "Initial commit: Complete Microsoft Marketplace application"
```

You should see output showing files being committed.

---

## Step 7: Rename Branch to Main

```bash
# Rename branch to main
git branch -M main
```

---

## Step 8: Add GitHub Remote

Replace `YOUR_USERNAME` with your actual GitHub username:

```bash
# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/microsoft-marketplace.git
```

**Example**: If your username is `tshepo123`:
```bash
git remote add origin https://github.com/tshepo123/microsoft-marketplace.git
```

---

## Step 9: Push to GitHub

```bash
# Push code to GitHub
git push -u origin main
```

### If Prompted for Username and Password:

**⚠️ IMPORTANT**: GitHub doesn't accept passwords anymore!

Instead:
1. **Username**: Enter your GitHub username
2. **Password**: Use a **Personal Access Token** (NOT your GitHub password)

**How to get a token**:
1. Go to: https://github.com/settings/tokens
2. Click **"Generate new token"** > **"Generate new token (classic)"**
3. Name: `Microsoft Marketplace`
4. Expiration: Choose duration (90 days or No expiration)
5. Select scope: Check **`repo`** (this checks all sub-boxes)
6. Click **"Generate token"** at bottom
7. **⚠️ COPY THE TOKEN** (you won't see it again!)
8. Use this token as your password when pushing

---

## Step 10: Verify Success

After successful push:

```bash
# Verify remote is set up
git remote -v
```

You should see:
```
origin  https://github.com/YOUR_USERNAME/microsoft-marketplace.git (fetch)
origin  https://github.com/YOUR_USERNAME/microsoft-marketplace.git (push)
```

---

## Step 11: View on GitHub

Open browser and go to:
```
https://github.com/YOUR_USERNAME/microsoft-marketplace
```

You should see all your files! 🎉

---

## Troubleshooting

### Problem: "remote origin already exists"

```bash
# Remove existing remote
git remote remove origin

# Then add it again
git remote add origin https://github.com/YOUR_USERNAME/microsoft-marketplace.git
```

### Problem: "src refspec main does not match any"

```bash
# Make sure you've committed
git commit -m "Initial commit"

# Then try pushing again
git push -u origin main
```

### Problem: Authentication Failed

You're probably using your GitHub password. Use a **Personal Access Token** instead (see Step 9).

**Or** store credentials so you don't have to enter them every time:

```bash
# Tell Git to remember credentials
git config --global credential.helper store

# Next push will ask for credentials, then remember them
git push -u origin main
```

### Problem: Permission Denied (SSH)

If you see this, you used an SSH URL. Either:

**Option A**: Switch to HTTPS
```bash
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/microsoft-marketplace.git
git push -u origin main
```

**Option B**: Set up SSH keys (more complex)
- Follow: https://docs.github.com/en/authentication/connecting-to-github-with-ssh

---

## Future Updates

After making changes to your code:

```bash
# See what changed
git status

# Add changes
git add .

# Commit with description
git commit -m "Description of what you changed"

# Push to GitHub
git push
```

---

## Alternative: Use GitHub Desktop (GUI)

If you prefer a visual interface:

1. Download GitHub Desktop: https://desktop.github.com/
2. Install and login
3. File > Add Local Repository
4. Select the `microsoft-marketplace` folder
5. Click "Publish repository"
6. Done!

---

## Verification Checklist

After pushing, verify:

- ✅ Go to your repository on GitHub
- ✅ You should see all folders (app, config, database, etc.)
- ✅ You should see README.md, composer.json, etc.
- ✅ You should **NOT** see `.env` file (it should be ignored)
- ✅ You should see `.env.example` file

---

## What Gets Pushed (and What Doesn't)

**✅ Pushed to GitHub**:
- All source code files
- Configuration files
- Documentation (README, etc.)
- .env.example (template)
- Database migrations

**❌ NOT Pushed** (in .gitignore):
- .env (your actual credentials)
- /vendor (Composer packages)
- /node_modules (NPM packages)
- Logs and cache files
- IDE settings

---

## Need More Help?

**GitHub Documentation**:
- Getting Started: https://docs.github.com/en/get-started
- Push an existing repository: https://docs.github.com/en/migrations/importing-source-code/using-the-command-line-to-import-source-code/adding-locally-hosted-code-to-github

**Video Tutorials**:
- Search YouTube for: "How to push code to GitHub"

**Contact**:
- If still stuck, the error message usually tells you what's wrong
- Copy the error and search Google for solution

---

## Success! What's Next?

Once your code is on GitHub:

1. **Clone on another computer**:
   ```bash
   git clone https://github.com/YOUR_USERNAME/microsoft-marketplace.git
   ```

2. **Add collaborators**:
   - Repository > Settings > Collaborators > Add people

3. **Protect your main branch**:
   - Repository > Settings > Branches > Add rule

4. **Set up automated deployments**:
   - Use GitHub Actions (see `.github/workflows` folder)

---

**You've got this!** Follow the steps carefully and you'll have your code on GitHub in 5 minutes.
