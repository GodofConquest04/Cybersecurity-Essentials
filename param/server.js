const express = require('express');
const path = require('path');
const jwt = require('jsonwebtoken');
const cookieParser = require('cookie-parser');

const app = express();
const SECRET_KEY = 'OWASP_TCET_supersecretkeyasjdlfajslkdfnkvncnaslkfdj';

app.use(express.json());
app.use(cookieParser());

app.use(express.static(path.join(__dirname)));

app.post('/param', (req, res) => {
  const data = req.body || {};

  if (typeof data.isAdmin === 'undefined') {
    data.isAdmin = false;
  }

  if (data.username === 'guest' && data.password === 'guest') {
    const token = jwt.sign(data, SECRET_KEY, { expiresIn: '1h' });
    res.cookie('token', token, { httpOnly: true });

    const redirectPath = data.isAdmin ? '/administrator' : '/dashboard';

    return res.json({
      message: 'Login successful',
      token,
      redirect: redirectPath
    });
  } else {
    return res.json({ error: 'Invalid credentials' });
  }
});

function verifyToken(req, res, next) {
  const token = req.cookies.token;
  if (!token) return res.redirect('/');

  try {
    req.user = jwt.verify(token, SECRET_KEY);
    next();
  } catch {
    return res.redirect('/');
  }
}

app.get('/administrator', verifyToken, (req, res) => {
  if (req.user.isAdmin) {
    res.send(`
  <style>
.owasp-header {
  background: #000;
  color: #fff;
  width: 100%;
  box-sizing: border-box;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 2px solid rgba(255,255,255,0.05);
}

.owasp-header__inner {
  max-width: 1100px;
  margin: 0 auto;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  position: relative; /* to position children relative to this */
  z-index: 5; /* base z-index for inner container */
}

 .owasp-header__left {
  display: flex;
  align-items: center;
  gap: 10px;
  position: relative;
  z-index: 10; /* higher so it stays above header background */
}

.owasp-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: transparent !important;
  border-radius: 0 !important;
  position: relative;
  z-index: 15; /* highest so logo is always on top */
  box-shadow: 0 0 8px rgba(0,0,0,0.5); /* subtle shadow for separation */
}

.owasp-logo img {
  height: 40px;
  width: auto;
  display: block;
  background: transparent;
  position: relative;
  z-index: 15;
}

.owasp-title {
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #fff;
  font-size: 18px;
  position: relative;
  z-index: 11;
}

.owasp-header__right {
  display: flex;
  gap: 14px;
  align-items: center;
  position: relative;
  z-index: 10;
}

.owasp-header__right a {
  color: white;
  text-decoration: none;
  font-weight: normal;  /* unbold the text */
  transition: color 0.3s ease, text-decoration 0.3s ease;
}

.owasp-header__right a:hover,
.owasp-header__right a:focus {
  color: #4CAF50; /* bright green hover */
  text-decoration: underline;
  outline: none;
}


    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .login-container {
      max-width: 320px;
      background: white;
      margin: 100px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      box-sizing: border-box;
      text-align: center;
    }

    .login-container h2 {
      margin-top: 0;
      color: #333;
      font-weight: 700;
      margin-bottom: 15px;
    }

    label {
      font-weight: 600;
      color: #555;
      display: block;
      margin-bottom: 5px;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #3498db;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 16px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .note {
      font-size: 14px;
      color: #777;
      margin-bottom: 20px;
    }

    #result {
      color: red;
      white-space: pre-wrap;
      height: 15px;
      margin-top: 5px;
      display: none;
    }
  </style>

<header class="owasp-header" role="banner" aria-label="OWASP TCET header">
  <div class="owasp-header__inner">
    <div class="owasp-header__left">
      <a href="https://owasp.tcetmumbai.in" class="owasp-logo" aria-label="OWASP TCET home link">
        <img src="/owasp-logo.svg" alt="OWASP TCET Logo" />
      </a>
      <span class="owasp-title">OWASP TCET</span>
    </div>

    <nav class="owasp-header__right" role="navigation" aria-label="Social links">
      <a href="https://in.linkedin.com/company/owasp-tcet" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">LinkedIn</a>
      <a href="https://www.instagram.com/tcet_owasp/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">Instagram</a>
      <a href="https://www.meetup.com/owasp-tcet-chapter/" target="_blank" rel="noopener noreferrer" aria-label="Meetup">Meetup</a>
    </nav>
  </div>
</header>
<body style="margin: 0; background-color: #1f2937; color: white; font-family: Arial, sans-serif;">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 4rem 1rem; text-align: center; min-height: 50vh;">
        <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 0.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">
            Welcome Admin!
        </h1>
        <p style="font-size: 1.1rem; background: rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
            Your role: Admin
        </p>
        <p style="font-size: 1.1rem; background: rgba(46, 204, 113, 0.2); padding: 0.5rem 1rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); margin-top: 0.5rem;">
            GG you solved mass assignment!
        </p>
    </div>
</body>
    `);
  }
else if(req.user.isAdmin === false){
    res.send(`<h2 style='color:red; text-align:center; margin-top:50px;'>❌ You are not an admin!</h2>`)
}
 else {
    res.redirect('/');
  }
});

app.get('/dashboard', verifyToken, (req, res) => {
  res.send(`
    <style>
.owasp-header {
  background: #000;
  color: #fff;
  width: 100%;
  box-sizing: border-box;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 2px solid rgba(255,255,255,0.05);
}

.owasp-header__inner {
  max-width: 1100px;
  margin: 0 auto;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  position: relative; /* to position children relative to this */
  z-index: 5; /* base z-index for inner container */
}

 .owasp-header__left {
  display: flex;
  align-items: center;
  gap: 10px;
  position: relative;
  z-index: 10; /* higher so it stays above header background */
}

.owasp-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: transparent !important;
  border-radius: 0 !important;
  position: relative;
  z-index: 15; /* highest so logo is always on top */
  box-shadow: 0 0 8px rgba(0,0,0,0.5); /* subtle shadow for separation */
}

.owasp-logo img {
  height: 40px;
  width: auto;
  display: block;
  background: transparent;
  position: relative;
  z-index: 15;
}

.owasp-title {
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #fff;
  font-size: 18px;
  position: relative;
  z-index: 11;
}

.owasp-header__right {
  display: flex;
  gap: 14px;
  align-items: center;
  position: relative;
  z-index: 10;
}

.owasp-header__right a {
  color: white;
  text-decoration: none;
  font-weight: normal;  /* unbold the text */
  transition: color 0.3s ease, text-decoration 0.3s ease;
}

.owasp-header__right a:hover,
.owasp-header__right a:focus {
  color: #4CAF50; /* bright green hover */
  text-decoration: underline;
  outline: none;
}


    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .login-container {
      max-width: 320px;
      background: white;
      margin: 100px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      box-sizing: border-box;
      text-align: center;
    }

    .login-container h2 {
      margin-top: 0;
      color: #333;
      font-weight: 700;
      margin-bottom: 15px;
    }

    label {
      font-weight: 600;
      color: #555;
      display: block;
      margin-bottom: 5px;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #3498db;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 16px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .note {
      font-size: 14px;
      color: #777;
      margin-bottom: 20px;
    }

    #result {
      color: red;
      white-space: pre-wrap;
      height: 15px;
      margin-top: 5px;
      display: none;
    }
  </style>

<header class="owasp-header" role="banner" aria-label="OWASP TCET header">
  <div class="owasp-header__inner">
    <div class="owasp-header__left">
      <a href="https://owasp.tcetmumbai.in" class="owasp-logo" aria-label="OWASP TCET home link">
        <img src="/owasp-logo.svg" alt="OWASP TCET Logo" />
      </a>
      <span class="owasp-title">OWASP TCET</span>
    </div>

    <nav class="owasp-header__right" role="navigation" aria-label="Social links">
      <a href="https://in.linkedin.com/company/owasp-tcet" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">LinkedIn</a>
      <a href="https://www.instagram.com/tcet_owasp/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">Instagram</a>
      <a href="https://www.meetup.com/owasp-tcet-chapter/" target="_blank" rel="noopener noreferrer" aria-label="Meetup">Meetup</a>
    </nav>
  </div>
</header>
<body style="margin: 0; background-color: #1f2937; color: white; font-family: Arial, sans-serif;">

    <!-- First Section -->
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 4rem 1rem; text-align: center; min-height: 50vh;">
        <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 0.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">
            Welcome ${req.user.isAdmin ? 'Admin' : 'Guest'}!
        </h1>
        <p style="font-size: 1.1rem; background: rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
            Your role: ${req.user.isAdmin ? 'Admin' : 'Guest'}
        </p>
    </div>
</body>

  `);
});

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Mass Assignment lab running on http://localhost:${PORT}`);
});
