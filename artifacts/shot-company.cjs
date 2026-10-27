const { chromium } = require('playwright');

const BASE = 'http://127.0.0.1:3001';
const OUT = __dirname;
const fs = require('fs');
fs.mkdirSync(OUT, { recursive: true });

const desktop = ['/pricing', '/about', '/contact', '/help', '/careers', '/press', '/terms', '/privacy', '/sitemap'];
const mobile = ['/pricing', '/about', '/contact', '/terms', '/careers', '/'];
const regression = ['/', '/google-search-ads'];

(async () => {
  const browser = await chromium.launch();
  let issues = 0;

  async function shoot(path, width, height, name) {
    const page = await browser.newPage({ viewport: { width, height } });
    const errors = [];
    const failed = [];
    page.on('console', m => { if (m.type() === 'error') errors.push(m.text()); });
    page.on('requestfailed', r => failed.push(r.url()));
    page.on('response', r => { if (r.status() >= 400) failed.push(r.status() + ' ' + r.url()); });

    await page.goto(BASE + path, { waitUntil: 'networkidle' });
    await page.waitForTimeout(400);
    await page.evaluate(async () => {
      const h = document.body.scrollHeight;
      for (let y = 0; y < h; y += 300) { window.scrollTo(0, y); await new Promise(r => setTimeout(r, 120)); }
      window.scrollTo(0, 0);
    });
    await page.waitForTimeout(800);

    const m = await page.evaluate(() => ({
      overflow: document.documentElement.scrollWidth > window.innerWidth + 1,
      unrevealed: document.querySelectorAll('[data-reveal]:not(.revealed)').length,
      styled: getComputedStyle(document.body).fontFamily.includes('Jakarta') || getComputedStyle(document.body).fontFamily.includes('Poppins'),
    }));

    const bad = m.overflow || errors.length || failed.length || m.unrevealed > 0 || !m.styled;
    if (bad) issues++;
    console.log(`${bad ? 'FAIL' : 'ok  '} ${name.padEnd(34)} overflow=${m.overflow} unrevealed=${m.unrevealed} styled=${m.styled} errors=${errors.length} failed=${failed.length}${errors.length ? ' :: ' + errors[0] : ''}${failed.length ? ' :: ' + failed[0] : ''}`);

    await page.screenshot({ path: `${OUT}/${name}.png`, fullPage: true });
    await page.close();
  }

  for (const p of desktop) await shoot(p, 1440, 900, 'new' + p.replace(/\//g, '-') + '-desktop');
  for (const p of mobile) await shoot(p, 390, 844, 'new' + (p === '/' ? '-home' : p.replace(/\//g, '-')) + '-mobile');
  for (const p of regression) await shoot(p, 1440, 900, 'regress' + (p === '/' ? '-home' : p.replace(/\//g, '-')) + '-desktop');

  console.log(`\ntotal issues: ${issues}`);
  await browser.close();
  process.exit(issues ? 1 : 0);
})();
