#!/bin/bash

# Automated GitHub Push Script
# This script will help you push the Microsoft Marketplace to GitHub

echo "🚀 Microsoft Marketplace - GitHub Push Helper"
echo "=============================================="
echo ""

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo "❌ Git is not installed. Please install git first:"
    echo "   Ubuntu/Debian: sudo apt install git"
    echo "   Mac: brew install git"
    echo "   Windows: Download from https://git-scm.com/"
    exit 1
fi

# Check if already a git repository
if [ -d .git ]; then
    echo "⚠️  This is already a git repository."
    read -p "Do you want to reinitialize? (y/N): " REINIT
    if [[ $REINIT =~ ^[Yy]$ ]]; then
        rm -rf .git
    else
        echo "Exiting. Use 'git push' to push changes."
        exit 0
    fi
fi

echo "📝 Let's set up your GitHub repository"
echo ""

# Get GitHub username
read -p "Enter your GitHub username: " GITHUB_USERNAME
if [ -z "$GITHUB_USERNAME" ]; then
    echo "❌ Username cannot be empty"
    exit 1
fi

# Get repository name
read -p "Enter repository name [microsoft-marketplace]: " REPO_NAME
REPO_NAME=${REPO_NAME:-microsoft-marketplace}

# Choose between HTTPS or SSH
echo ""
echo "Choose authentication method:"
echo "1) HTTPS (recommended for most users)"
echo "2) SSH (if you have SSH keys configured)"
read -p "Enter choice [1]: " AUTH_CHOICE
AUTH_CHOICE=${AUTH_CHOICE:-1}

if [ "$AUTH_CHOICE" == "1" ]; then
    REPO_URL="https://github.com/${GITHUB_USERNAME}/${REPO_NAME}.git"
else
    REPO_URL="git@github.com:${GITHUB_USERNAME}/${REPO_NAME}.git"
fi

# Confirm
echo ""
echo "📋 Summary:"
echo "   GitHub Username: $GITHUB_USERNAME"
echo "   Repository Name: $REPO_NAME"
echo "   Repository URL:  $REPO_URL"
echo ""
read -p "Is this correct? (y/N): " CONFIRM
if [[ ! $CONFIRM =~ ^[Yy]$ ]]; then
    echo "❌ Cancelled. Run the script again."
    exit 0
fi

# Set up Git config if not set
if [ -z "$(git config --global user.name)" ]; then
    read -p "Enter your name for Git commits: " GIT_NAME
    git config --global user.name "$GIT_NAME"
fi

if [ -z "$(git config --global user.email)" ]; then
    read -p "Enter your email for Git commits: " GIT_EMAIL
    git config --global user.email "$GIT_EMAIL"
fi

echo ""
echo "🔧 Initializing Git repository..."
git init

echo "📦 Adding files to Git..."
git add .

echo "💾 Creating initial commit..."
git commit -m "Initial commit: Complete Microsoft Marketplace application

- White-label Laravel application for Microsoft CSP partners
- Multi-country support (Cameroon, South Africa, Ghana)
- Microsoft Partner Center API integration
- Multi-language (English, French)
- Multiple payment gateways
- Admin dashboard with branding management"

echo "🌐 Adding GitHub remote..."
git branch -M main
git remote add origin "$REPO_URL"

echo ""
echo "⚠️  IMPORTANT: Before pushing, make sure you have created the repository on GitHub:"
echo ""
echo "1. Go to: https://github.com/new"
echo "2. Repository name: $REPO_NAME"
echo "3. Keep it PRIVATE (recommended)"
echo "4. Do NOT initialize with README"
echo "5. Click 'Create repository'"
echo ""
read -p "Have you created the repository on GitHub? (y/N): " CREATED
if [[ ! $CREATED =~ ^[Yy]$ ]]; then
    echo ""
    echo "⏸️  Setup paused. After creating the repository, run:"
    echo "   git push -u origin main"
    exit 0
fi

echo ""
echo "🚀 Pushing to GitHub..."
if git push -u origin main; then
    echo ""
    echo "✅ Success! Your code is now on GitHub!"
    echo ""
    echo "🔗 View at: https://github.com/${GITHUB_USERNAME}/${REPO_NAME}"
    echo ""
    echo "📝 Next steps:"
    echo "1. Add a description to your repository"
    echo "2. Add collaborators if needed"
    echo "3. Set up branch protection for main branch"
    echo "4. Consider adding GitHub Actions for CI/CD"
    echo ""
else
    echo ""
    echo "❌ Push failed. This might be due to:"
    echo ""
    if [ "$AUTH_CHOICE" == "1" ]; then
        echo "🔐 Authentication Issue (HTTPS):"
        echo "   - GitHub no longer accepts passwords"
        echo "   - You need a Personal Access Token"
        echo "   - Create one at: https://github.com/settings/tokens"
        echo "   - When prompted for password, use the token"
        echo ""
        echo "Or set up credential helper:"
        echo "   git config --global credential.helper store"
    else
        echo "🔑 SSH Key Issue:"
        echo "   - Make sure you have SSH keys set up"
        echo "   - Add your key at: https://github.com/settings/keys"
        echo "   - Test with: ssh -T git@github.com"
    fi
    echo ""
    echo "After fixing authentication, run:"
    echo "   git push -u origin main"
fi

echo ""
echo "💡 Useful commands:"
echo "   git status          - Check what changed"
echo "   git add .           - Stage all changes"
echo "   git commit -m 'msg' - Commit changes"
echo "   git push            - Push to GitHub"
echo "   git pull            - Pull latest changes"
