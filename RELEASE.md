# Release Instructions

This document describes the process for creating and publishing new releases of WP_Field.

## Prerequisites

- Write access to the GitHub repository
- Packagist account with access to `rwsite/wp-field`
- All tests passing (`composer test`)
- Code style check passing (`composer lint:check`)
- Static analysis passing (`composer analyse`)

## Release Process

### 1. Prepare the Release

```bash
# Ensure you're on the main branch
git checkout main
git pull origin main

# Run all quality checks
composer test
composer analyse
composer lint:check

# Build React components
npm install
npm run build
```

### 2. Update Version Numbers

Update version in the following files:

- `composer.json` - `"version": "X.Y.Z"`
- `WP_Field.php` - Plugin header `Version: X.Y.Z`
- `package.json` - `"version": "X.Y.Z"`

### 3. Update CHANGELOG.md

Add a new section for the release:

```markdown
## [X.Y.Z] - YYYY-MM-DD

### Added
- New features

### Changed
- Changes to existing functionality

### Fixed
- Bug fixes

### Deprecated
- Soon-to-be removed features

### Removed
- Removed features

### Security
- Security fixes
```

### 4. Commit Changes

```bash
git add .
git commit -m "Release v3.0.0"
git push origin main
```

### 5. Create Git Tag

```bash
# Create annotated tag
git tag -a v3.0.0 -m "Release version 3.0.0"

# Push tag to GitHub
git push origin v3.0.0
```

### 6. Create GitHub Release

1. Go to https://github.com/rwsite/wp-field-plugin/releases/new
2. Select the tag you just created
3. Set release title: `v3.0.0`
4. Copy changelog content to release description
5. Attach build artifacts if needed
6. Click "Publish release"

### 7. Publish to Packagist

Packagist should automatically detect the new tag and update the package. If not:

1. Go to https://packagist.org/packages/rwsite/wp-field
2. Click "Update" button
3. Verify the new version appears

## Version Numbering

We follow [Semantic Versioning](https://semver.org/):

- **MAJOR** (X.0.0): Breaking changes, incompatible API changes
- **MINOR** (0.X.0): New features, backward-compatible
- **PATCH** (0.0.X): Bug fixes, backward-compatible

### Examples

- `3.0.0` - Major release with breaking changes (v2.x → v3.x)
- `3.1.0` - Minor release with new features
- `3.1.1` - Patch release with bug fixes

## Pre-release Versions

For beta/RC releases:

```bash
# Beta release
git tag -a v3.0.0-beta.1 -m "Beta 1 for version 3.0.0"

# Release candidate
git tag -a v3.0.0-rc.1 -m "Release candidate 1 for version 3.0.0"
```

## Hotfix Process

For urgent fixes to production:

```bash
# Create hotfix branch from main
git checkout -b hotfix/3.0.1 main

# Make fixes
# ... edit files ...

# Update version numbers
# Update CHANGELOG.md

# Commit and merge
git commit -am "Hotfix: Fix critical bug"
git checkout main
git merge --no-ff hotfix/3.0.1
git tag -a v3.0.1 -m "Hotfix release 3.0.1"
git push origin main --tags

# Delete hotfix branch
git branch -d hotfix/3.0.1
```

## CI/CD Pipeline

GitHub Actions automatically runs on every push and PR:

- **Tests**: PHPUnit/Pest tests on PHP 8.0, 8.1, 8.2, 8.3
- **Static Analysis**: PHPStan Level 9
- **Code Style**: Laravel Pint
- **React Build**: Vite build for React components

All checks must pass before merging to main.

## Rollback

If a release has critical issues:

```bash
# Revert to previous version
git revert <commit-hash>
git push origin main

# Create new patch release
git tag -a v3.0.2 -m "Rollback critical issue from 3.0.1"
git push origin v3.0.2
```

## Post-Release Checklist

- [ ] Verify package on Packagist
- [ ] Test installation via Composer
- [ ] Update documentation if needed
- [ ] Announce release (if major/minor)
- [ ] Close related GitHub issues
- [ ] Update project roadmap

## Support

For questions about the release process:

- GitHub Issues: https://github.com/rwsite/wp-field-plugin/issues
- Email: alex@rwsite.ru
