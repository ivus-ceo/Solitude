<?php
  declare(strict_types = 1);

  session_start();

  include 'includes/autoloader.php';

  $link = new DataBase();

  include 'scripts/functions.php';
  include 'scripts/login-user.php';
  include 'scripts/upload-file.php';
  // include 'scripts/search-in-db.php';

  $user_data = $link->__SQLSELECT('users', 'user_id', 1);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'includes/head.php' ?>
    <title>Ivan Uskov's Diary</title>
  </head>
  <body>
    <main class="__main-container-wrapper">
      <div class="__left-column">
        <section class="__section-container">
          <div class="__section-header-title">
            <h1>Solitude</h1>
          </div>

          <div class="__section-person-container">
            <div class="__person-avatar">
              <img id="__avatar-image" src="media/uploads/<?php echo $user_data->user_image ?>" alt="avatar">
              <!-- Upload icon -->
              <?php if (isset($_SESSION['id'])): ?>
                <div class="__avatar-upload">
                  <i class="fad fa-upload"></i>
                  <input type="file" onchange="__funcCropperModal(this)" title="Upload image">
                </div>
              <?php endif; ?>
            </div>

            <div class="__person-info">
              <h1>Introduction</h1>
              <p>My name is Ivan Uskov and this is my blog! I am web developer from Kazakhstan. I have experience in web site design and building, also my major education is mechanical engineering and also I am developing machines and mechanisms.</p>
            </div>
          </div>
        </section>
      </div>

      <div class="__right-column">
        <section class="__section-container">
          <div class="__section-header-title">
            <h1>Information</h1>
          </div>

          <div class="__section-paramount-information">
            <div class="__paramount-statistics">
              <h1>Statistics</h1>
              <p>Website has been working for <span>5 months</span>. I was online <span>1241</span> and I had written <span>231 articles</span>. Last article was created <span>1 week ago at 15:14</span>. Currently the longest article has <span>521 words</span> in it.</p>
            </div>

            <div class="__paramount-form">
              <?php if (!isset($_SESSION['id'])): ?>
                <h1>Login</h1>
                <form action="./" method="POST">
                  <div class="__form-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="user_login" placeholder=" " autocomplete="off" value="<?php if (isset($_COOKIE['cookie_uid'])) { echo $_COOKIE['cookie_uid']; } else { echo ""; } ?>" required>
                    <span class="__placer">Login / E-Mail</span>
                  </div>

                  <div class="__form-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="user_password" placeholder=" " autocomplete="off" minlength="6" value="<?php if (isset($_COOKIE['cookie_pwd'])) { echo $_COOKIE['cookie_pwd']; } ?>" required>
                    <span class="__placer">Password</span>
                    <span onclick="__funcDisplay(this)"><i class="fas fa-eye"></i></span>
                  </div>

                  <div class="__form-input">
                    <div class="__switch">
                      <input type="checkbox" name="user_remember" onclick="__funcSwitch(this)" <?php if (isset($_COOKIE['cookie_uid']) && isset($_COOKIE['cookie_pwd'])) { echo "checked"; } ?>>
                      <div class="__slider"></div>
                    </div>
                    <span>Remember Me</span>
                  </div>

                  <?php if (!empty($_GET['error']) && !empty($_GET['login']) && $_GET['login'] == TRUE) { ?>
                    <div class="__form-message">
                      <?php
                        switch ($_GET['error']) {
                          case 'empty-fields':
                            echo '<i class="fas fa-exclamation"></i>You did not fill out all the fields';
                            break;
                          case 'invalid-login':
                            echo '<i class="fas fa-exclamation"></i>Invalid login';
                            break;
                          case 'user-not-found':
                            echo '<i class="fas fa-exclamation"></i>User does not exist';
                            break;
                          case 'wrong-password':
                            echo '<i class="fas fa-exclamation"></i>Wrong password';
                            break;
                          default:
                            echo '<i class="fas fa-exclamation"></i>Undefined error';
                            break;
                        }
                      ?>
                    </div>
                  <?php }; ?>

                  <button type="submit" name="login-button"><i class="fas fa-sign-in-alt"></i>Login</button>
                </form>
              <?php endif; ?>

              <?php if (isset($_SESSION['id'])): ?>
                <h1>Welcome Back!</h1>
                <p>Good to see you again, let's get to work in articles section.</p>
                <a href="logout?logout=true">
                  <button type="button"><i class="fas fa-sign-out-alt"></i>Logout</button>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <?php if (isset($_SESSION['id'])): ?>
          <section class="__section-container">
            <div class="__section-header-title">
              <h1>My Articles</h1>
            </div>

            <!-- <div class="__section-navbar-container">
              <div class="__navbar-button">
                <small>Write a new article</small>
              </div>

              <div class="__navbar-button">

              </div>

              <div class="__navbar-button">

              </div>

              <div class="__navbar-button">

              </div>
            </div> -->

            <div class="__section-search-container">
              <div class="__search-header-title" onclick="__funcDisplayAccordion(this)">
                <h1>Advanced Search</h1>
                <i class="fas fa-chevron-down"></i>
              </div>

              <div class="__search-entire-container">
                <form action="./" method="POST">
                  <div class="__form-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="search_query" onkeyup="__ajaxSearchQuery(this)" placeholder=" " autocomplete="off">
                    <span class="__placer">Title</span>
                    <div class="__input-dropdown">
                      <menu>

                      </menu>
                    </div>
                  </div>

                  <div class="__form-columns">
                    <div class="__left-column-form">
                      <div class="__form-select">
                        <i class="fas fa-list"></i>
                        <div class="__select-input">
                          <span class="__placer">Category</span>
                          <i class="fas fa-caret-down"></i>
                        </div>

                        <div class="__select-dropdown">
                          <menu>
                            <li>Category</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Problems</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Thoughts</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Knowledge</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Business</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Something</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">Other</li>
                          </menu>
                        </div>
                      </div>

                      <div class="__form-select">
                        <i class="far fa-calendar-day"></i>
                        <div class="__select-input">
                          <span class="__placer">Day of month</span>
                          <i class="fas fa-caret-down"></i>
                        </div>

                        <div class="__select-dropdown">
                          <menu>
                            <li>Day of month</li>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                              <li class="__dropdown-option" onclick="__funcSelectOptions(this)"><?php echo $i ?></li>
                            <?php endfor; ?>
                          </menu>
                        </div>
                      </div>
                    </div>

                    <div class="__right-column-form">
                      <div class="__form-select">
                        <i class="far fa-calendar-alt"></i>
                        <div class="__select-input">
                          <span class="__placer">Month</span>
                          <i class="fas fa-caret-down"></i>
                        </div>

                        <div class="__select-dropdown">
                          <menu>
                            <li>Month</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">January</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">February</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">March</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">April</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">May</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">June</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">July</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">August</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">September</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">October</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">November</li>
                            <li class="__dropdown-option" onclick="__funcSelectOptions(this)">December</li>
                          </menu>
                        </div>
                      </div>

                      <div class="__form-select">
                        <i class="far fa-calendar-star"></i>
                        <div class="__select-input">
                          <span class="__placer">Year</span>
                          <i class="fas fa-caret-down"></i>
                        </div>

                        <div class="__select-dropdown">
                          <menu>
                            <li>Year</li>
                            <?php for ($i = 0; $i < 18; $i++): ?>
                              <li class="__dropdown-option" onclick="__funcSelectOptions(this)"><?php echo date('Y', strtotime('+'.$i.' Year')); ?></li>
                            <?php endfor; ?>
                          </menu>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="__form-buttons">
                    <button type="button"><i class="fas fa-times-circle"></i>Cancel</button>
                    <button type="submit"><i class="fas fa-search"></i>Search</button>
                  </div>

                </form>
              </div>
            </div>

            <div class="__section-articles-container">
              <div class="__article-container">
                <div class="__article-image">
                  <img src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Image">
                  <nav>
                    <small>Problems</small>
                  </nav>
                </div>
                <div class="__article-title">
                  <h1>Making Design For Myself</h1>
                </div>
                <div class="__article-footer">
                  <p>20 April 2020, 15:14</p>
                  <p>5 minutes</p>
                </div>
              </div>

              <div class="__article-container">
                <div class="__article-image">
                  <img src="https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=654&q=80" alt="Image">
                  <nav>
                    <small>Thoughts</small>
                  </nav>
                </div>
                <div class="__article-title">
                  <h1>The truth about me</h1>
                </div>
                <div class="__article-footer">
                  <p>20 April 2020, 15:14</p>
                  <p>10 minutes</p>
                </div>
              </div>

              <div class="__article-container">
                <div class="__article-image">
                  <img src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80" alt="Image">
                  <nav>
                    <small>Business</small>
                  </nav>
                </div>
                <div class="__article-title">
                  <h1>How To Become Better With UI Design</h1>
                </div>
                <div class="__article-footer">
                  <p>20 April 2020, 15:14</p>
                  <p>8 minutes</p>
                </div>
              </div>

              <div class="__article-container">
                <div class="__article-image">
                  <img src="https://images.unsplash.com/photo-1451976426598-a7593bd6d0b2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="Image">
                  <nav>
                    <small>Knowledge</small>
                  </nav>
                </div>
                <div class="__article-title">
                  <h1>The Truth About Design In 3 Minutes</h1>
                </div>
                <div class="__article-footer">
                  <p>20 April 2020, 15:14</p>
                  <p>7 minutes</p>
                </div>
              </div>
            </div>

            <button type="button"><i class="fas fa-spinner"></i>Load more</button>
          </section>
        <?php endif; ?>

        <section class="__section-container">
          <div class="__section-header-title">
            <h1>Footer</h1>
          </div>

          <div class="__section-footer-container">
            <!-- footer -->
          </div>
        </section>
      </div>
    </main>

    <footer class="__footer-container-wrapper">
      <section class="__section-container" id="__modal-crop">
        <div class="__section-header-title">
          <h1>Cropper</h1>
        </div>

        <div class="__section-cropper-container">
          <div class="__cropper-times">
            <i class="fas fa-times"></i>
          </div>

          <div class="__cropper-image">
            <img id="__cropper-image" src="">
          </div>

          <div class="__cropper-buttons">
            <button name="cancel" type="button"><i class="fas fa-times-circle"></i>Cancel</button>
            <button name="crop" type="button"><i class="fas fa-save"></i>Save changes</button>
          </div>
        </div>
      </section>

      <section class="__section-container" id="__modal-confirmation">
        <div class="__section-confirmation-container">
          <h1 id="__message">Are you sure?</h1>

          <div class="__confirmation-times">
            <i class="fas fa-times"></i>
          </div>

          <div class="__confirmation-buttons">
            <button id="__answer-failure" type="button">No</button>
            <button id="__answer-success" type="button">Yes</button>
          </div>
        </div>
      </section>
    </footer>

    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>

    <script>
      AOS.init({
        duration: 400,
        once: true,
        offset: 300
      });
      /* Call Function Ripple */
      __funcRippleEffect();
      /* Call Select Opener */
      __funcSelectInput();
    </script>

  </body>
</html>
