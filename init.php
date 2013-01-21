<?php
//Core files
require_once 'core/url_parser.php';
require_once 'core/controller/class.BaseController.php';
require_once 'core/class.Flash.php';
require_once 'core/interface.DAO.php';
require_once 'core/interface.DbConnection.php';
require_once 'core/class.MysqlConnection.php';
require_once 'core/class.MysqlDAO.php';
require_once 'core/error.inc.php';
require_once 'core/HtmlTag.class.php';
require_once 'core/application_functions.php';

//Controllers
require_once 'controllers/accounts_controller.php';
require_once 'controllers/schools_controller.php';
require_once 'controllers/students_controller.php';
require_once 'controllers/traineeships_controller.php';
require_once 'controllers/phases_controller.php';
require_once 'controllers/milestones_controller.php';
require_once 'controllers/reports_controller.php';
require_once 'controllers/links_controller.php';
require_once 'controllers/crons_controller.php';
require_once 'controllers/licences_controller.php';
require_once 'controllers/educationlevels_controller.php';
require_once 'controllers/languagelevels_controller.php';
require_once 'controllers/cvs_controller.php';

//Models
require_once 'models/model.Account.php';
require_once 'models/model.School.php';
require_once 'models/model.Student.php';
require_once 'models/model.Traineeship.php';
require_once 'models/model.Phase.php';
require_once 'models/model.Milestone.php';
require_once 'models/model.Report.php';
require_once 'models/model.Link.php';
require_once 'models/model.Licence.php';
require_once 'models/model.EducationLevel.php';
require_once 'models/model.LanguageLevel.php';
require_once 'models/model.CV.php';

?>
