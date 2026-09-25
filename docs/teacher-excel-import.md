# Teacher Excel import

Upload one Excel file to create **teachers** and their **login users** at the same time.

## Short command

```bash
cd API
php artisan teachers:import storage/app/teachers.xlsx --branch=1 --cur=2
```

Generate a template first:

```bash
php artisan teachers:import --template
```

Preview without saving:

```bash
php artisan teachers:import storage/app/teachers.xlsx --branch=1 --cur=2 --dry-run
```

## From the website

1. Open **School → Teachers**
2. Click **Import**
3. Download the template, or use your own file
4. Choose a default role if you want
5. Click **Import**
6. After success, click **Export results** to download username/password backup Excel

The current branch and curriculum from the header are used.

## Excel columns

| Column | Required | Example |
|---|---|---|
| `name_kh` | Yes | សុខ វិរៈ |
| `name_en` | Yes | Sok Vireak |
| `gender` | No | `male` or `female` |
| `nation` | No | `kh` |
| `dob` | No | `1990-05-20` |
| `phone` | No | `098765432` |
| `role` | No | `administration` |

First row must be headers. Extra title rows above the header are OK.

## What gets created

Each valid row creates:

- a **user**
- a **teacher** linked to that user

Login details:

- Username: English name, lowercase, spaces become dots (`Sok Vireak` → `sok.vireak`)
- Password: default password + username (`dewey@123sok.vireak`)
- User code: `T-000001`, `T-000002`, …
- Duplicate names get `-2`, `-3` on the username
- The same teacher name in the same curriculum is skipped

## Options

```bash
php artisan teachers:import FILE --branch=1 --cur=2 --role=administration
```

- `--branch` branch ID
- `--cur` curriculum ID
- `--role` role name or ID
- `--dry-run` parse only, do not write
