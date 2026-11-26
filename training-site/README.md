# Training-led version

A separate version of the AlgoProfessor Q1 website that leads with the **12-day SCI Q1 Paper Writing Training**:

> Twelve days from a research gap to a submitted Q1 manuscript

It has the same design, logo, 3D globe, visitor counter and content as the main site in the repository root. The two differ in what they put first:

| | `training-site/` (this folder) | Root `index.html` |
|---|---|---|
| Headline | Twelve days from a research gap to a submitted Q1 manuscript | Earn your author position on a Q1 SCI paper |
| First section after the hero | 12-day journey calendar | Author-position ladder (1st to 6th author) |
| Globe labels | None ("six roles") | 1st to 6th author |

## Deploy

Upload `index.html` and `counter.php` from this folder to the document root of the domain or subdomain where you want this version, using cPanel's File Manager. The steps are the same as in the main [README](../README.md#deploy-on-cpanel).

Each folder keeps its own visitor count, because `counter.php` writes `visits.json` next to itself.
