<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->checkLogin();
		$select = array('producttbl.*', 'categorytbl.categoryName', 'subcategorytbl.subCategoryName');
		$data = array(
			'page_title' => 'Product | Task',
			'productDetails' => $this->Home_model->getProductDetail($select, array())
		);

		$this->load->view('template/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('template/footer');
	}

	public function loginPage()
	{
		$data = array(
			'page_title' => 'Login | Task',
		);

		$this->load->view('pages/page-login', $data);
	}

	public function registerPage()
	{
		$data = array(
			'page_title' => 'Register | Task',
		);

		$this->load->view('pages/page-register', $data);
	}

	public function submitUser()
	{
		if (!isset($_POST['fullNameInput'])) {
			echo 'User Name Required';
		}

		if (!isset($_POST['emailInput'])) {
			echo 'User Name Required';
			return false;
		} else {
			if (!filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
				echo "Invalid email format";
				return false;
			} else {
				$findUser = $this->Home_model->findUserWhere(array('userEmail' => $_POST['emailInput']));
				if (count($findUser) != 0) {
					echo 'User already registered !!!';
					return false;
				}
			}
		}

		if (!isset($_POST['passwordInput'])) {
			echo 'User Name Required';
		}

		$name = $_FILES['profile']['name'];
		$target_dir = "assets/images/";
		$target_file = $_FILES['profile']['name'];
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$extensions_arr = array("jpg", "jpeg", "png");
		$newFileName = $target_dir . date('d-m-Y_H-i-s') . $name;
		if (in_array($imageFileType, $extensions_arr)) {
			if (move_uploaded_file($_FILES['profile']['tmp_name'], $newFileName)) {
				$formdata = array(
					'fullName' => $_POST['fullNameInput'],
					'userEmail' => $_POST['emailInput'],
					'userPass' => $_POST['passwordInput'],
					'userProfile' => $newFileName
				);
				$userID = $this->Home_model->registerUser($formdata);
				$this->session->set_userdata('userlogged_in', $userID);
				echo 'success';
			} else {
				echo 'Some thing went Wrong !!!!';
			}
		} else {
			echo 'This File Type not match !!!!';
		}
	}

	public function loginCheck()
	{
		if (!filter_var($_POST['emailInput'], FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format";
			return false;
		} else {
			$findUser = $this->Home_model->findUserWhere(array('userEmail' => $_POST['emailInput']));
			if (count($findUser) == 0) {
				echo 'User not registered !!!';
				return false;
			} else {
				if ($findUser[0]->userPass == $_POST['passwordInput']) {
					$this->session->set_userdata('userlogged_in', $findUser[0]->id);
					echo 'success';
				} else {
					echo 'Password not match !!!';
					return false;
				}
			}
		}
	}

	public function category()
	{
		$this->checkLogin();
		$data = array(
			'page_title' => 'Category | Task',
			'category' => $this->Home_model->getCategory()
		);

		$this->load->view('template/header', $data);
		$this->load->view('pages/page-category', $data);
		$this->load->view('template/footer');
	}

	public function subCateory()
	{
		$select = array('subcategorytbl.*', 'categorytbl.categoryName');
		$this->checkLogin();
		$data = array(
			'page_title' => 'Sub Category | Task',
			'subcategory' => $this->Home_model->getSubCategory($select, array(), 'left'),
			'category' => $this->Home_model->getCategory(),
		);

		$this->load->view('template/header', $data);
		$this->load->view('pages/page-sub-category', $data);
		$this->load->view('template/footer');
	}

	public function logout()
	{
		if ($this->session->has_userdata('userlogged_in')) {
			$this->session->unset_userdata('userlogged_in');
			redirect(base_url('login'));
		}
	}

	public function checkLogin()
	{
		if (!$this->session->has_userdata('userlogged_in')) {
			redirect(base_url('login'));
		}
	}

	public function submitCategory()
	{
		if (empty($_POST['categoryName'])) {
			echo 'category Must be !!!';
			return false;
		}

		$formdata = array(
			'categoryName' => $_POST['categoryName']
		);

		if (empty($_POST['categoryID'])) {
			$this->Home_model->insertCategory($formdata);
			echo 'success';
		} else {
			$where = array('id' => $_POST['categoryID']);
			$this->Home_model->updateCategory($formdata, $where);
			echo 'success';
		}
	}

	public function submitSubCategory()
	{
		if (empty($_POST['category_IdFk'])) {
			echo 'Select Category Name !!!';
			return false;
		}

		if (empty($_POST['subCategoryName'])) {
			echo 'sub category Must be !!!';
			return false;
		}

		$formdata = array(
			'category_IdFk' => $_POST['category_IdFk'],
			'subCategoryName' => $_POST['subCategoryName'],
		);

		if (empty($_POST['subcategoryID'])) {
			$this->Home_model->insertSubCategory($formdata);
			echo 'success';
		} else {
			$where = array('id' => $_POST['subcategoryID']);
			$this->Home_model->updateSubCategory($formdata, $where);
			echo 'success';
		}
	}

	public function getAllCategory()
	{
		$result = $this->Home_model->getCategory();
		echo json_encode($result);
	}

	public function getAllSubCategory()
	{
		$result = $this->Home_model->getAllSubCategoryCond(array('category_IdFk' => $_POST['categoryId']));
		echo json_encode($result);
	}

	public function deleteSubCategory()
	{
		$where = array('id' => $_POST['subcat']);
		$this->Home_model->deleteSubCategory($where);
		echo 'success';
	}

	public function deleteCategory()
	{
		$where = array('id' => $_POST['categoryID']);
		$this->Home_model->deleteCategory($where);
		echo 'success';
	}

	public function addProduct()
	{
		$this->checkLogin();
		$data = array(
			'page_title' => 'Category | Task',
			'categories' => $this->Home_model->getCategory()
		);

		$this->load->view('template/header', $data);
		$this->load->view('pages/page-add-product', $data);
		$this->load->view('template/footer');
	}

	public function editProduct($param)
	{
		$this->checkLogin();
		$select = array('producttbl.*', 'categorytbl.categoryName', 'subcategorytbl.subCategoryName');
		$data = array(
			'page_title' => 'Category | Task',
			'categories' => $this->Home_model->getCategory(),
			'productDetail' => $this->Home_model->getProductDetail($select, array('producttbl.id' => $param))[0]
		);

		$this->load->view('template/header', $data);
		$this->load->view('pages/page-edit-product', $data);
		$this->load->view('template/footer');
	}

	public function submitProductDetail()
	{
		if (empty($_POST['categoryId'])) {
			echo 'select category !!!';
			return false;
		}
		if (empty($_POST['subcategoryId'])) {
			echo 'select sub category !!!';
			return false;
		}
		if (empty($_POST['productTitle'])) {
			echo 'enter product title !!!';
			return false;
		}
		if (empty($_POST['productDescription'])) {
			echo 'enter product description !!!';
			return false;
		}
		if (empty($_POST['productAmount'])) {
			echo 'enter product amount !!!';
			return false;
		}
		if (empty($_POST['productDiscType'])) {
			echo 'enter product discount type !!!';
			return false;
		}
		if (empty($_POST['productDiscAmount'])) {
			echo 'enter product discount amount !!!';
			return false;
		}

		$formdata = array(
			'cat_IdFk' => $_POST['categoryId'],
			'subcat_IdFk' => $_POST['subcategoryId'],
			'productTitle' => $_POST['productTitle'],
			'productDescription' => $_POST['productDescription'],
			'productAmount' => $_POST['productAmount'],
			'productDiscType' => $_POST['productDiscType'],
			'productDiscAmount' => $_POST['productDiscAmount'],
			'roductPayableAmount' => $_POST['productPayableAmount'],
		);
		$this->Home_model->insertProduct($formdata);
		echo 'success';
	}
}
