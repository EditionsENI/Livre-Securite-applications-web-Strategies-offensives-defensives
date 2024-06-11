<ul class="nav flex-column pt-2 border-end menu">
  <li class="nav-item">
    <a class="nav-link text-light text-decoration-none fs-5 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#chapter6" role="button">Les principales vulnérabilités web</a>
    <ul class="nav flex-column collapse" id="chapter6">
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#idor" role="button">Insecure Direct Object Reference (IDOR)</a>
        <ul class="nav flex-column collapse" id="idor">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/idor/idor_1/index.php'; ?>">Numeric query parameter</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/idor/idor_2/index.php'; ?>">Hidden field</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/idor/idor_3/index.php'; ?>">Complex identifiers (UUID)</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/idor/idor_4/index.php'; ?>">Side-Channel IDOR</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/idor/idor_5/index.php'; ?>">Path Traversal</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#sqli" role="button">SQL Injection</a>
        <ul class="nav flex-column collapse" id="sqli">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_1/index.php'; ?>">Authentication bypass</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_2/index.php'; ?>">Union-based</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_3/index.php'; ?>">Error-based</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_4/index.php'; ?>">Stack queries</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_5/index.php'; ?>">Second order</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_6/index.php'; ?>">Boolean-based</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_7/index.php'; ?>">Time-based</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_8/index.php'; ?>">Arbitrary file read</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/sqli/sqli_9/index.php'; ?>">Remote code execution</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#command_injection" role="button">Command Injection</a>
        <ul class="nav flex-column collapse" id="command_injection">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/osinjection/osinjection_1/index.php'; ?>">Shell argument injection</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/osinjection/osinjection_2/index.php'; ?>">Blind injection</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#code_injection" role="button">Code Injection</a>
        <ul class="nav flex-column collapse" id="code_injection">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/codeinjection/codeinjection_1/index.php'; ?>">Remote File Inclusion</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/codeinjection/codeinjection_2/index.php'; ?>">Local File Inclusion</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#xss" role="button">Cross-Site Scripting (XSS)</a>
        <ul class="nav flex-column collapse" id="xss">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/xssinjection/xssinjection_1/index.php'; ?>">Reflected XSS</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/xssinjection/xssinjection_2/index.php'; ?>">Stored XSS</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/xssinjection/xssinjection_3/index.php'; ?>">Dom-based XSS</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#broken_authentication" role="button">Broken Authentication</a>
        <ul class="nav flex-column collapse" id="broken_authentication">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/broken_authentication/broken_authentication_1/index.php'; ?>">User enumeration</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/broken_authentication/broken_authentication_2/index.php'; ?>">Session Fixation</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/broken_authentication/broken_authentication_3/index.php'; ?>">Weak Session ID</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#broken_access_control" role="button">Broken Access Control</a>
        <ul class="nav flex-column collapse" id="broken_access_control">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/broken_access_control/broken_access_control_1/index.php'; ?>">Horizontal access control</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/broken_access_control/broken_access_control_2/index.php'; ?>">Vertical access control</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#open_redirect" role="button">Open Redirect</a>
        <ul class="nav flex-column collapse" id="open_redirect">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/open_redirect/open_redirect_1/index.php'; ?>">Get parameter</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#cross_site_request_forgery" role="button">Cross-Site Request Forgery (CSRF)</a>
        <ul class="nav flex-column collapse" id="cross_site_request_forgery">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/cross_site_request_forgery/cross_site_request_forgery_1/index.php'; ?>">POST request</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/cross_site_request_forgery/cross_site_request_forgery_2/index.php'; ?>">POST request with XSS</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light text-decoration-none fs-5 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#chapter7" role="button">Autres vulnérabilités applicatives</a>
    <ul class="nav flex-column collapse" id="chapter7">
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#business" role="button">Business Logic Vulnerabilitiy</a>
        <ul class="nav flex-column collapse" id="business">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/business_logic_vulnerability/business_logic_vulnerability_1/index.php'; ?>">Star Rating</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/business_logic_vulnerability/business_logic_vulnerability_2/index.php'; ?>">Total Amount</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#deserialization" role="button">Insecure Deserialization</a>
        <ul class="nav flex-column collapse" id="deserialization">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/insecure_deserialization/insecure_deserialization_1/index.php'; ?>">Object manipulation</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/insecure_deserialization/insecure_deserialization_2/index.php'; ?>">Object injection</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#redos" role="button">Regular expression Denial of Service (ReDoS)</a>
        <ul class="nav flex-column collapse" id="redos">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/regular_expression_denial_of_service/regular_expression_denial_of_service_1/index.php'; ?>">Client Side ReDoS</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#ssrf" role="button">Server-Side Request Forgery (SSRF)</a>
        <ul class="nav flex-column collapse" id="ssrf">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/ssrf/ssrf_1/index.php'; ?>">Avatar upload</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#xxe" role="button">XML external entity (XXE)</a>
        <ul class="nav flex-column collapse" id="xxe">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/xxe/xxe_1/index.php'; ?>">Arbitrary file read</a>
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/xxe/xxe_2/index.php'; ?>">Blind injection</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary text-decoration-none fs-6 fw-bold text-start pb-0" data-bs-toggle="collapse" href="#ssti" role="button">Server-Side Template Injection (SSTI)</a>
        <ul class="nav flex-column collapse" id="ssti">
          <li class="nav-item">
            <a class="nav-link text-light text-decoration-none fs-6 text-start pt-1 pb-1" href="<?php echo WEP_APP_PAGE_TO_ROOT . 'exercices/ssti/ssti_1/index.php'; ?>">TWIG</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>